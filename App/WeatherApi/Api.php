<?php
namespace App\WeatherApi;

class Api
{
	private string $apiKey = "c693ce26e1e6094cd72c9f7bfaaecb5b";
	private string $apiUrl = "http://api.openweathermap.org/data/2.5/weather?id=";
	private string $cityId = "727011";
	private string $metric = 'metric';
	private mixed $value;

	/**
	 * @return mixed
	 */
	public function getValue(): mixed
	{
		return $this->value;
	}


	public function __construct()
	{
		$this->value = $this->convertToJson();
	}

	/**
	 * @return string
	 */
	private function prepareUrlData(): string {
		return  $this->apiUrl .
				$this->cityId . '&appid=' .
				$this->apiKey . '&units=' .
				$this->metric;
	}

	/**
	 * @return string
	 */
	private function retrieveDataFromServer(): string
	{
		return file_get_contents($this->prepareUrlData());
	}


	/**
	 * @return mixed
	 */
	private function convertToJson() : mixed
	{
		return json_decode($this->retrieveDataFromServer(), true);
	}
}