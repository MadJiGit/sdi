<?php

namespace App\Service;

use App\Data\UserDTO;
use App\Repository\UserRepositoryInterface;
use mysql_xdevapi\Exception;

class UserService implements UserServiceInterface
{
	/**
	 * @var UserRepositoryInterface
	 */
	private UserRepositoryInterface $userRepository;

	/**
	 * @param UserRepositoryInterface $userRepository
	 */
	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;
	}


	public function register(UserDTO $userDTO, string $confirmPassword): bool
	{

		var_dump("register username " . $userDTO->getUsername() . "\n");
		var_dump("register password " . $userDTO->getPassword() . "\n");
		var_dump("register email" . $userDTO->getEmail() . "\n");
		var_dump("register egn" . $userDTO->getEGN() . "\n");

		if($userDTO->getPassword() !== $confirmPassword) {
			throw new \Exception("Passwords mismatch!");
		}

		if(null !== $this->userRepository->findOneByUsername($userDTO->getUsername())){
			throw new \Exception("Username already taken!");
		}

		if(null !== $this->userRepository->findOneByEmail($userDTO->getEmail())){
			throw new \Exception("User with this email already exist!");
		}

		$this->encryptPassword($userDTO);

		return $this->userRepository->insert($userDTO);
	}

	/**
	 * @param string $data
	 * @param string $password
	 * @return UserDTO|null
	 * @throws \Exception
	 */
	public function login(string $data, string $password): ?UserDTO
	{
		$user = $this->userRepository->findOneUserByData($data);

		if(null == $user){
			throw new \Exception("User not exist! You might want to register first\nOr if you have registration can try to recover your password.");
		}

		$userPasswordHash = $user->getPassword();

		if(false === password_verify($password, $userPasswordHash)){
			throw new \Exception("Invalid password!");
		}

		return $user;

	}

	public function resetPassword(string $email, string $username, string $confirmPassword): bool
	{
		// TODO: Implement resetPassword() method.

		return 0;
	}

	public function currentUser(): ?UserDTO
	{
		if(!isset($_SESSION['id'])) {
			return null;
		}
		return $this->userRepository->findOne($_SESSION['id']);
	}

	public function getById(int $id): ?UserDTO
	{
		return $this->userRepository->findOne($id);
	}

	/**
	 * @inheritDoc
	 */
	public function all(): \Generator
	{
		return $this->userRepository->findAll();
	}

	public function isLogged(): bool
	{
		if($this->currentUser() === null){
			return false;
		}
		return true;
	}

	/**
	 * @param UserDTO $userDTO
	 * @throws \Exception
	 */
	private function encryptPassword(UserDTO $userDTO): void
	{
		$plainPassword = $userDTO->getPassword();
		$passwordHash = password_hash($plainPassword, PASSWORD_DEFAULT);
		$userDTO->setPassword($passwordHash);
	}

	/**
	 * @throws \Exception
	 */
	public function update(UserDTO $userDTO, mixed $confirm_password): bool
	{
		$user = $this->userRepository->findOneByEmail($userDTO->getEmail());
		if(null === $user){
			throw new \Exception("Email do not exist!");
		}

		if($userDTO->getUsername() !== $user->getUsername()){
			throw new \Exception("Username is not correct!");
		}

		if($userDTO->getPassword() !== $confirm_password) {
			throw new \Exception("Passwords mismatch!");
		}

		$this->encryptPassword($userDTO);

		return $this->userRepository->insert($userDTO);
	}


}