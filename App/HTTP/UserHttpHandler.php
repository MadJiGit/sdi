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
//		try {
//			$this->userService->forgetPassword($formData['email']);
//			$this->redirect("reset_pass.php");
//		} catch (Exception $ex){
//			$this->render("users/forget_pass", $formData, [$ex->getMessage()]);
//		}
		if (isset($formData['forget_pass'])) {
			var_dump("forgetPassword 2 " . $formData['email'] . "\n");

			try {
				$this->userService->forgetPassword($formData['email']);
				$this->redirect("reset_pass.php");
			} catch (Exception $ex){
				$this->render("users/forget_pass", $formData, [$ex->getMessage()]);
			}

			//$this->redirect("reset_pass.php");
		} else {
			$this->render("users/forget_pass");
		}

//		try {
//			if (!isset($formData['email']) || null === $formData['email'] = $this->userService->currentUser()->getEmail()) {
//				throw new Exception("mail is nor correct");
//			}
//			$this->redirect("reset_pass.php");
//		} catch (Exception $ex) {
//			$this->render("users/forget_pass", $formData, [$ex->getMessage()]);
//		}
	}

	/**
	 * @throws Exception
	 */
	public function resetPassword(array $formData = [])
	{
		var_dump("resetPassword(array $formData = [])");
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
		//var_dump("handlerResetPasswordProcess " . $formData['username'] . "\n");
//		try {
//			if (!isset($formData['email']) || null === $formData['email'] = $this->userService->currentUser()->getEmail()) {
//				throw new Exception("mail is nor correct");
//			}
//		} catch (Exception $ex) {
//			$this->render("users/forget_pass", $formData, [$ex->getMessage()]);
//		}


		try {
			$user = $this->dataBinder->bind($formData, UserDTO::class);
			$this->userService->resetPassword($user, $formData['confirm_password']);
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
		var_dump("handlerRegisterProcess " . $formData . "\n");
		try {
			$user = $this->dataBinder->bind($formData, UserDTO::class);
			$this->userService->register($user, $formData['confirm_password']);
			//$_SESSION['username'] = $formData['username'];
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
			$currentUser = $this->userService->login($formData['data'], $formData['password']);
			$currentUser->setIsChek($res);
			var_dump("current user" . $currentUser->getUsername() . "\n");
			$_SESSION['id'] = $currentUser->getId();
			$this->redirect("profile.php");
		} catch (Exception $ex) {
			$this->render("users/login", null, [$ex->getMessage()]);
		}
	}
}