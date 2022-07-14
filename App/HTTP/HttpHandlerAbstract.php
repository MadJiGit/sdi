<?php

namespace App\Http;

use Core\DataBinderInterface;
use Core\TemplateInterface;

abstract class HttpHandlerAbstract
{
	/**
	 * @var TemplateInterface
	 */
	private TemplateInterface $template;

	/**
	 * @var DataBinderInterface
	 */
	protected DataBinderInterface $dataBinder;

	public function __construct(TemplateInterface $template, DataBinderInterface $dataBinder)
	{
		$this->template = $template;
		$this->dataBinder = $dataBinder;
	}

	public function render(string $templateName, $data = null,array $errors=[]){
		$this->template->render($templateName, $data,$errors);
	}

	public function redirect(string $url){
		header("Location: $url");
	}


}