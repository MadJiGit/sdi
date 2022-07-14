<?php

namespace App\Http;

use App\Data\UserDTO;
use App\Service\UserServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;
use Exception;
use JetBrains\PhpStorm\Pure;

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
			$this->redirect("login.php");
		}

		$this->render("home/profile", $currentUser);
	}

	public function index()
	{
		$this->render("static/pages-sign-in.html");
	}

	public function login(array $formData = [])
	{
		if(isset($formData['login'])){
			$this->handlerLoginProcess($formData);
		} else {
			$this->render("static/pages-sign-in.html");
		}
	}

	public function registerUser(array $formData = [])
	{
		if (isset($formData['register'])) {
			$this->handlerRegisterProcess($formData);
		} else {
			$this->render("static/pages-sign-up.html");
		}
	}

	public function forgetPassword(array $formData = [])
	{
		if (isset($formData['forget_password'])) {
			$this->handlerResetPasswordProcess($formData);
		} else {
			$this->render("static/pages-reset-password.html");
		}
	}

	public function resetPassword(array $formData = [])
	{
		if (isset($formData['reset_password'])) {
			$this->handlerResetPasswordProcess($formData);
		} else {
			$this->render("static/pages-new-password.html");
		}
	}

	/**
	 * @param array $formData
	 */
	private function handlerRegisterProcess(array $formData): void
	{
		try {
			$user = $this->dataBinder->bind($formData, UserDTO::class);
			$this->userService->register($user, $formData['confirm_password']);
			$_SESSION['username'] = $formData['username'];
			$_SESSION['success'] = "Congratulations " . $_SESSION['username'] . ". Login to our platform";
			$this->redirect("login.php");
		} catch (Exception $ex) {
			//$this->render("users/register", $formData, [$ex->getMessage()]);
			$this->render("static/pages-sign-up.html", $formData, [$ex->getMessage()]);
		}
	}

	private function handlerLoginProcess(array $formData): void
	{
		try {
			$currentUser = $this->userService->login($formData['username'], $formData['password']);
			$_SESSION['id'] = $currentUser->getId();
			$this->redirect("profile.php");
		} catch (Exception $ex) {
			//$this->render("users/login", null, [$ex->getMessage()]);
			$this->render("static/pages-sign-in.html", null, [$ex->getMessage()]);
		}
	}

	/**
	 * @throws Exception
	 */
	private function handlerResetPasswordProcess(array $formData, string $email)
	{
		/*
		// TODO check if user is login and username and email are correct
		$user = $this->userService->currentUser();

		if($user->getUsername() !== $formData['username']) {
			throw new Exception("Username is not valid for this user!");
		}
		*/
		$formData['email'] = $this->userService->currentUser()->getEmail();

		try {
			$user = $this->dataBinder->bind($formData, UserDTO::class);
			$this->userService->update($user, $formData['confirm_password']);
			$this->redirect("login.php");
		} catch (Exception $ex) {
			$this->render("static/pages-new-password.html", $formData, [$ex->getMessage()]);
		}
	}
}