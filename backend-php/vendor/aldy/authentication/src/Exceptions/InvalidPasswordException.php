<?php
namespace Aldy\Authentication\Exceptions;

class InvalidPasswordException extends AuthException {
    public function __construct() {
        parent::__construct("invalid password");
    }
}