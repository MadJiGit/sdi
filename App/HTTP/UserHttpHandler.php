<?php

namespace App\Http;

use App\Data\UserDTO;
use App\Service\UserServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;
use Exception;

class UserHttpHandler extends HttpHandlerAbstract
{
	/**
	 * @var UserServiceInterface
	 */
	private UserServiceInterface $userService;

	/**
	 * @param TemplateInterface $template
	 * @param DataBinderInterface $dataBinder
	 * @param UserServiceInterface $userService
	 */
	public function __construct(TemplateInterface $template, DataBinderInterface $dataBinder, UserServiceInterface $userService)
	{
		parent::__construct($template, $dataBinder);
		$this->userService = $userService;
	}

	public function profile(array $formData = [])
	{
		$currentUser = $this->userService->currentUser();

		if (null == $currentUser) {
			$_SESSION['warning'] = "You can't change password!\n";
			$this->redirect("login.php");
		}

		$_SESSION['success'] = "Congratulations " . $currentUser->getUsername() . ".\nYou are successfully login.";
		$this->render("users/profile", $currentUser);
	}

	public function index()
	{
		$this->render("users/login");
	}

	public function login(array $formData = [])
	{
		if (isset($formData['login'])) {
			$this->handlerLoginProcess($formData);
		} else {
			$this->render("users/login");
		}
	}

	public function registerUser(array $formData = [])
	{
		if (isset($formData['register'])) {
			$this->handlerRegisterProcess($formData);
		} else {
			$this->render("users/register");
		}
	}

	/**
	 * @throws Exception
	 */
	public function forgetPassword(array $formData = [])
	{
		if (isset($formData['forget_pass'])) {
			try {
				$this->userService->forgetPassword(trim($formData['email']));
				$_SESSION['email'] = trim($formData['email']);
				$this->redirect("reset_pass.php");
			} catch (Exception $ex) {
				$this->render("users/forget_pass", $formData, [$ex->getMessage()]);
			}
		} else {
			$this->render("users/forget_pass");
		}
	}

	/**
	 * @throws Exception
	 */
	public function resetPassword(array $formData = [])
	{
		if (isset($formData['reset_pass'])) {
			$this->handlerResetPasswordProcess($formData);
		} else {
			$this->render("users/reset_pass");
		}
	}

	/**
	 * @throws Exception
	 */
	private function handlerResetPasswordProcess(array $formData)
	{
		try {
			$user = $this->dataBinder->bind($formData, UserDTO::class);
			$user->setEmail(trim($_SESSION['email']));
			$this->userService->resetPassword($user, trim($formData['confirm_password']));
			$_SESSION['success'] = "Congratulations " . $user->getUsername() . ".\nYou are successfully change your password.\n Please login.";
			$this->redirect("login.php");
		} catch (Exception $ex) {
			$this->render("users/reset_pass", $formData, [$ex->getMessage()]);
		}
	}

	/**
	 * @param array $formData
	 */
	private function handlerRegisterProcess(array $formData): void
	{
		try {
			$user = $this->dataBinder->bind($formData, UserDTO::class);
			$this->userService->register($user, trim($formData['confirm_password']));
			$_SESSION['success'] = "Congratulations " . $user->getUsername() . ".\nPlease login to our platform";
			$this->redirect("login.php");
		} catch (Exception $ex) {
			$this->render("users/register", $formData, [$ex->getMessage()]);
		}
	}

	private function handlerLoginProcess(array $formData): void
	{
		$res = (isset($formData['remember']) && $formData['remember'] === 'on') ? "true" : "false";
		try {
			$currentUser = $this->userService->login(trim($formData['data']), trim($formData['password']));
			$currentUser->setIsChek($res);
			$_SESSION['id'] = $currentUser->getId();
			$this->redirect("profile.php");
		} catch (Exception $ex) {
			$this->render("users/login", null, [$ex->getMessage()]);
		}
	}
}