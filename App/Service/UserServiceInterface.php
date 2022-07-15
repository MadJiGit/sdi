<?php

namespace App\Service;


use App\Data\UserDTO;
use http\Client\Curl\User;

interface UserServiceInterface
{
	public function register(UserDTO $userDTO, string $confirmPassword): bool;

	public function login(string $data, string $password): ?UserDTO;

	public function resetPassword(UserDTO $UserDTO, string $confirmPassword): bool;

	public function forgetPassword(string $email): bool;

	public function getById(int $id): ?UserDTO;

	public function currentUser(): ?UserDTO;

	public function isLogged(): bool;
}