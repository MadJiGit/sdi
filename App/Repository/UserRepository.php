<?php

namespace App\Repository;

use App\Data\UserDTO;
use DB\DatabaseInterface;

class UserRepository implements UserRepositoryInterface
{

	/**
	 * @var DatabaseInterface
	 */
	private $db;

	/**
	 * @param DatabaseInterface $db
	 */
	public function __construct(DatabaseInterface $db)
	{
		$this->db = $db;
	}

	public function edit(UserDTO $userDTO): bool
	{
		$newPass = $userDTO->getPassword();
		$currrentEmail = $userDTO->getEmail();
		$this->db->query("
			UPDATE users SET 
			                 password = ?
          	WHERE email=?"
		)->execute([
			$newPass,
			$currrentEmail
		]);

		return true;
	}


	public function insert(UserDTO $userDTO): bool
	{
		$this->db->query("
			INSERT INTO users(username, password, email, egn)
			VALUES (?,?,?, ?)
		")->execute([
			$userDTO->getUsername(),
			$userDTO->getPassword(),
			$userDTO->getEmail(),
			$userDTO->getEGN(),
		]);

		return true;
	}

	public function findOneUserByData(string $data): ?UserDTO
	{
		$user = null;

		if (str_contains($data, '@')) {
			$user = $this->findOneByEmail($data);
		} else {
			$user = $this->findOneByUsername($data);
		}

		return $user;
	}

	public function findOneByUsername(string $username): ?UserDTO
	{
		return $this->db->query("
            SELECT username, password, email, egn 
            FROM users
            WHERE username = ?
        ")->execute([$username])
			->fetch(UserDTO::class)
			->current();
	}

	public function findOneByEmail(string $email): ?UserDTO
	{
		return $this->db->query("
            SELECT username, password, email, egn 
            FROM users
            WHERE email = ?
        ")->execute([$email])
			->fetch(UserDTO::class)
			->current();
	}

	public function findOne(int $egn): ?UserDTO
	{
		return $this->db->query("
            SELECT username, password, email, egn 
            FROM users
            WHERE egn = ?
        ")->execute([$egn])
			->fetch(UserDTO::class)
			->current();
	}

}