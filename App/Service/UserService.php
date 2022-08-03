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
		if ($userDTO->getPassword() !== $confirmPassword) {
			throw new \Exception("Passwords mismatch!");
		}

		if (null !== $this->userRepository->findOneByUsername($userDTO->getUsername())) {
			throw new \Exception("Username already taken!");
		}

		if (null !== $this->userRepository->findOneByEmail($userDTO->getEmail())) {
			throw new \Exception("User with this email already exist!");
		}

		if (null !== $this->userRepository->findOne($userDTO->getEGN())) {
			throw new \Exception("User with this EGN already exist!");
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

		if (null == $user) {
			throw new \Exception("User not exist! You might want to register first\nOr if you have registration can try to recover your password.");
		}

		$userPasswordHash = $user->getPassword();

		if (false === password_verify($password, $userPasswordHash)) {
			throw new \Exception("Invalid password!");
		}

		return $user;

	}

	/**
	 * @param string $email
	 * @return bool
	 * @throws \Exception
	 */
	public function forgetPassword(string $email): bool
	{
		if (empty($email)) {
			throw new \Exception("Email do not exist!");
		}
		$user = $this->userRepository->findOneByEmail($email);
		if (null === $user) {
			throw new \Exception("Email do not exist!");
		}

		return true;
	}

	/**
	 * @param UserDTO $userDTO
	 * @param string $confirmPassword
	 * @return bool
	 * @throws \Exception
	 */
	public function resetPassword(UserDTO $userDTO, string $confirmPassword): bool
	{
		$user = $this->userRepository->findOneByEmail($userDTO->getEmail());
		if (null === $user) {
			throw new \Exception("Email do not exist!");
		}

		if (trim($userDTO->getUsername()) !== $user->getUsername()) {
			throw new \Exception("Username is not correct!");
		}

		if (trim($userDTO->getPassword()) !== trim($confirmPassword)) {
			throw new \Exception("Passwords mismatch!");
		}

		$user->setPassword(trim($userDTO->getPassword()));
		$this->encryptPassword($userDTO);

		return $this->userRepository->edit($userDTO);
	}

	public function currentUser(): ?UserDTO
	{
		if (!isset($_SESSION['egn'])) {
			return null;
		}
		return $this->userRepository->findOne($_SESSION['egn']);
	}

	public function getById(int $egn): ?UserDTO
	{
		return $this->userRepository->findOne($egn);
	}

	public function isLogged(): bool
	{
		if ($this->currentUser() === null) {
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
}