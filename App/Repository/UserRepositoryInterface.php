<?php

namespace App\Repository;

use App\Data\UserDTO;

interface UserRepositoryInterface
{
	public function insert(UserDTO $userDTO): bool;

	public function edit(UserDTO $userDTO): bool;

	public function findOneUserByData(string $data): ?UserDTO;

	public function findOneByUsername(string $username): ?UserDTO;

	public function findOneByEmail(string $email): ?UserDTO;

	public function findOne(int $id): ?UserDTO;
}