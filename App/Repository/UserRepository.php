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
		var_dump("update username " . $userDTO->getUsername() . "\n");
		$newPass = $userDTO->getPassword();
		$currrentEmail= $userDTO->getEmail();
		var_dump("update new pass " . $newPass . "\n");
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
		var_dump("insert " . $userDTO->getUsername() . "\n");
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

		var_dump("findOneUserByData " . $data . "\n");

		if(str_contains($data, '@')) {
			var_dump("findOneByEmail start\n");
			$user = $this->findOneByEmail($data);
		} else {
			var_dump("findOneByUsername start\n");
			$user = $this->findOneByUsername($data);
		}

		return $user;
	}

	public function findOneByUsername(string $username): ?UserDTO
	{
		var_dump("findOneByUsername start\n");

		return $this->db->query("
            SELECT id, username, password, email, egn 
            FROM users
            WHERE username = ?
        ")->execute([$username])
			->fetch(UserDTO::class)
			->current();
	}

	public function findOneByEmail(string $email): ?UserDTO
	{
		var_dump("findOneByEmail start\n");

		return $this->db->query("
            SELECT id, username, password, email, egn 
            FROM users
            WHERE email = ?
        ")->execute([$email])
			->fetch(UserDTO::class)
			->current();
	}

	public function findOne(int $id): ?UserDTO
	{
		return $this->db->query("
            SELECT id, username, password, email, egn 
            FROM users
            WHERE id = ?
        ")->execute([$id])
			->fetch(UserDTO::class)
			->current();
	}

}