<?php
namespace Aldy\Authentication\contracts;

interface AuthInterface
{
    public function login(string $identifier, string $password): bool;
}