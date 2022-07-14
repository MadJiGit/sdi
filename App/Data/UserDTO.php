<?php

namespace App\Data;

use Exception;

class UserDTO
{
	const MAX_FIELD_LENGTH = 255;
	const USERNAME_MIN_LENGTH = 5;
	const PASSWORD_MIN_LENGTH = 8;
	const EMAIL_MIN_LENGTH = 5;
	const EGN_LENGTH = 10;

	/**
	 * @var integer
	 */
	private int $id;

	/**
	 * @var string
	 */
	private string $username;

	/**
	 * @var string
	 */
	private string $password;

	/**
	 * @var string
	 */
	private string $email;

	/**
	 * @var integer
	 */
	private int $egn;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id): void
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}

	/**
	 * @param string $username
	 * @throws Exception
	 */
	public function setUsername(string $username): void
	{
		if (strlen($username) < self::USERNAME_MIN_LENGTH || strlen($username) > self::MAX_FIELD_LENGTH) {
			throw new Exception("Username must be between " . self::USERNAME_MIN_LENGTH .
										" and " . self::MAX_FIELD_LENGTH);
		}
		$this->username = $username;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * @param string $password
	 * @throws Exception
	 */
	public function setPassword(string $password): void
	{
		if (strlen($password) < self::PASSWORD_MIN_LENGTH || strlen($password) > self::MAX_FIELD_LENGTH) {
			throw new Exception('Password must be between ' . self::PASSWORD_MIN_LENGTH . ' and ' . self::MAX_FIELD_LENGTH);
		}
		$this->password = $password;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 * @throws Exception
	 */
	public function setEmail(string $email): void
	{
		if (strlen($email) < self::PASSWORD_MIN_LENGTH || strlen($email) > self::MAX_FIELD_LENGTH) {
			throw new Exception('Email must be between ' . self::EMAIL_MIN_LENGTH . ' and ' . self::MAX_FIELD_LENGTH);
		}
		$this->email = $email;
	}

	/**
	 * @param int $egn
	 * @throws Exception
	 */
	public function setEgn(int $egn): void
	{
		$egn_length = strlen((string)$egn);

		if($egn_length != self::EGN_LENGTH){
			throw new Exception("The EGN is no valid. Must contain exact 10 numbers!");
		}

		$this->egn = $egn;
	}


	/**
	 * @return integer
	 */
	public function getEGN(): int
	{
		return $this->egn;
	}


}