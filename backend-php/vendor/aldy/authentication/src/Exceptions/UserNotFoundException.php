<?php
namespace Aldy\Authentication\Exceptions;

class UserNotFoundException extends AuthException {
    public function __construct() {
        parent::__construct("user not found");
    }
}