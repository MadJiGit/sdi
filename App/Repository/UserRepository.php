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
		var_dump("insert " . $userDTO);
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
		// TODO: Implement findOneByUsername() method.
	}

	public function findOneByEmail(string $email): ?UserDTO
	{
		// TODO: Implement findOneByEmail() method.
	}

	public function findOne(int $id): ?UserDTO
	{
		// TODO: Implement findOne() method.
	}
}