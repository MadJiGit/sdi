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

		if(str_contains($data, '@')) {
			$user = $this->findOneByEmail($data);
		} else {
			$user = $this->findOneByUsername($data);
		}

		return $user;
	}

	public function findOneByUsername(string $username): ?UserDTO
	{
		return $this->db->query("
            SELECT id, username, password, email 
            FROM users
            WHERE username = ?
        ")->execute([$username])
			->fetch(UserDTO::class)
			->current();
	}

	public function findOneByEmail(string $email): ?UserDTO
	{
		return $this->db->query("
            SELECT id, username, password, email 
            FROM users
            WHERE email = ?
        ")->execute([$email])
			->fetch(UserDTO::class)
			->current();
	}

	public function findOne(int $id): ?UserDTO
	{
		return $this->db->query("
            SELECT id, username, password, email 
            FROM users
            WHERE id = ?
        ")->execute([$id])
			->fetch(UserDTO::class)
			->current();
	}

}