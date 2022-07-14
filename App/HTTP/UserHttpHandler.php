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
			$this->redirect("login.php");
		}

		$this->render("home/profile", $currentUser);
	}

	public function index()
	{
		//$this->render("static/pages-sign-in.html");
		//$this->render("static/pages-sign-in.html");
		$this->render("users/login");
	}

	public function login(array $formData = [])
	{
		if(isset($formData['login'])){
			$this->handlerLoginProcess($formData);
		} else {
			//$this->render("static/pages-sign-in.html");
			$this->render("users/login");
		}
	}

	public function registerUser(array $formData = [])
	{
		var_dump("registerUser " . $formData);
		if (isset($formData['register'])) {
			$this->handlerRegisterProcess($formData);
		} else {
			//$this->render("static/pages-sign-up.html");
			$this->render("users/register");
		}
	}

	/**
	 * @throws Exception
	 */
	public function forgetPassword(array $formData = [])
	{
		var_dump("forgetPassword " . "\n");
		if (isset($formData['forget_pass'])) {
			var_dump("forgetPassword 2 " . $formData['email'] . "\n");
			$this->redirect("reset_pass.php");
		} else {
			//$this->render("static/pages-reset-password.html");
			$this->render("users/forget_pass");
		}
	}

	/**
	 * @throws Exception
	 */
	public function resetPassword(array $formData = [])
	{

		var_dump("resetPassword " . "\n");

		if (isset($formData['reset_pass'])) {
			$this->handlerResetPasswordProcess($formData);
		} else {
			//$this->render("static/pages-new-password.html");
			$this->render("users/reset_pass");
		}
	}

	/**
	 * @throws Exception
	 */
	private function handlerResetPasswordProcess(array $formData)
	{
		var_dump("handlerResetPasswordProcess " . $formData['username'] . "\n");
		$formData['email'] = $this->userService->currentUser()->getEmail();

		try {
			$user = $this->dataBinder->bind($formData, UserDTO::class);
			$this->userService->update($user, $formData['confirm_password']);
			$this->redirect("login.php");
		} catch (Exception $ex) {
			//$this->render("static/pages-new-password.html", $formData, [$ex->getMessage()]);
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
			$_SESSION['username'] = $formData['username'];
			$_SESSION['success'] = "Congratulations " . $_SESSION['username'] . ". Login to our platform";
			$this->redirect("login.php");
		} catch (Exception $ex) {
			//$this->render("users/register", $formData, [$ex->getMessage()]);
			//$this->render("static/pages-sign-up.html", $formData, [$ex->getMessage()]);
			$this->render("users/register", $formData, [$ex->getMessage()]);
		}
	}

	private function handlerLoginProcess(array $formData): void
	{
		try {
			$currentUser = $this->userService->login($formData['data'], $formData['password']);

			var_dump("current user" . $currentUser->getUsername() ."\n");
			$_SESSION['id'] = $currentUser->getId();
			var_dump("before redirect\n");
			$this->redirect("profile.php");
		} catch (Exception $ex) {
			//$this->render("users/login", null, [$ex->getMessage()]);
			//$this->render("static/pages-sign-in.html", null, [$ex->getMessage()]);
			var_dump("error " . [$ex->getMessage()]);
			$this->render("users/login", null, [$ex->getMessage()]);
		}
	}


}