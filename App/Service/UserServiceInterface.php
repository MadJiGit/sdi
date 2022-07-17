<?php

namespace App\Service;


use App\Data\UserDTO;
use http\Client\Curl\User;

interface UserServiceInterface
{
	public function register(UserDTO $userDTO, string $confirmPassword) : bool;

	public function login(string $data, string $password) : ?UserDTO;

	public function resetPassword(string $email, string $username, string $confirmPassword) : bool;

	public function getById(int $id): ?UserDTO;

	public function currentUser() : ?UserDTO;

	/**
	 * @return \Generator|UserDTO[]
	 */
	public function all() : \Generator;

	public function isLogged() : bool;

	public function update(string $data,  mixed $password, mixed $confirm_password) : bool;

}