<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\User;
use App\Domain\ValueObjects\UserId;
use App\Domain\ValueObjects\Email;


interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function findById(UserId $id): ?User;
    public function findByEmail(Email $email): ?User;
    public function delete(UserId $id): void;
}