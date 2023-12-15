<?php

namespace App\DTO\Mails;

class CreateRepresentativeMailDTO {
    public function __construct(
        public string $password
    ) {}
}