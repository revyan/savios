<?php
namespace Aldy\Authentication;
use Aldy\Authentication\Contracts\AuthInterface;
use Aldy\Authentication\Exceptions\InvalidPasswordException;
use Aldy\Authentication\Exceptions\UserNotFoundException;
final class UserLogin implements AuthInterface
{
    private \PDO $pdo;
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function login(string $identifier, string $password): bool
    {
        if ($this->isEmail($identifier)) {
            $stmt = $this->pdo->prepare("SELECT `password` FROM users WHERE email = :identifier LIMIT 1");
        } else {
            $stmt = $this->pdo->prepare("SELECT `password` FROM users WHERE `name` = :identifier LIMIT 1");
        }

        $stmt->bindParam(':identifier', $identifier, \PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if (!password_verify($password, $user['password'])) {
            throw new InvalidPasswordException();
        }

        return true;
    }
    private function isEmail(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL)
            && preg_match('/@.+\./', $value);
    }

}