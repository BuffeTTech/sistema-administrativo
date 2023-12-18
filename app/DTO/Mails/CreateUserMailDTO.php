<?php

namespace App\DTO\Mails;

class CreateUserMailDTO {
    public function __construct(
        public string $password,
        public string $user_type
    ) {}
}