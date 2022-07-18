<?php

namespace App\Data;

class WeatherDTO
{
	/**
	 * @var integer
	 */
	private int $timeRaw;

	/**
	 * @var string
	 */
	private string $time;

	/**
	 * @var string
	 */
	private string $date;

	/**
	 * @var string
	 */
	private string $mainCurrentTemp;

	/**
	 * @var string
	 */
	private string $mainMinTemp;

	/**
	 * @var string
	 */
	private string $mainMaxTemp;

	/**
	 * @var string
	 */
	private string $mainPressure;

	/**
	 * @var string
	 */
	private string $mainHumidity;

	/**
	 * @var string
	 */
	private string $windSpeed;

	/**
	 * @var string
	 */
	private string $cityName;


	public function __construct(mixed $data)
	{
		$this->setCityName($data['name']);
		$this->setMainCurrentTemp($data['main']['temp']);
		$this->setMainHumidity($data['main']['humidity']);
		$this->setMainMaxTemp($data['main']['temp_max']);
		$this->setMainMinTemp($data['main']['temp_min']);
		$this->setMainPressure($data['main']['pressure']);
		$this->setWindSpeed($data['wind']['speed']);
		$this->setTimeRaw();
		$this->setDate($this->timeRaw);
		$this->setTime($this->timeRaw);
	}


	/**
	 * @return string
	 */
	public function getCityName(): string
	{
		return $this->cityName;
	}

	/**
	 * @param string $cityName
	 */
	private function setCityName(string $cityName): void
	{
		$this->cityName = $cityName;
	}

	/**
	 * @return string
	 */
	public function getMainCurrentTemp(): string
	{
		return $this->mainCurrentTemp;
	}

	/**
	 * @param string $mainCurrentTemp
	 */
	private function setMainCurrentTemp(string $mainCurrentTemp): void
	{
		$this->mainCurrentTemp = $mainCurrentTemp;
	}

	/**
	 * @return string
	 */
	public function getMainMinTemp(): string
	{
		return $this->mainMinTemp;
	}

	/**
	 * @param string $mainMinTemp
	 */
	private function setMainMinTemp(string $mainMinTemp): void
	{
		$this->mainMinTemp = $mainMinTemp;
	}

	/**
	 * @return string
	 */
	public function getMainMaxTemp(): string
	{
		return $this->mainMaxTemp;
	}

	/**
	 * @param string $mainMaxTemp
	 */
	private function setMainMaxTemp(string $mainMaxTemp): void
	{
		$this->mainMaxTemp = $mainMaxTemp;
	}

	/**
	 * @return string
	 */
	public function getMainPressure(): string
	{
		return $this->mainPressure;
	}

	/**
	 * @param string $mainPressure
	 */
	private function setMainPressure(string $mainPressure): void
	{
		$this->mainPressure = $mainPressure;
	}

	/**
	 * @return string
	 */
	public function getMainHumidity(): string
	{
		return $this->mainHumidity;
	}

	/**
	 * @param string $mainHumidity
	 */
	private function setMainHumidity(string $mainHumidity): void
	{
		$this->mainHumidity = $mainHumidity;
	}

	/**
	 * @return string
	 */
	public function getWindSpeed(): string
	{
		return $this->windSpeed;
	}

	/**
	 * @param string $windSpeed
	 */
	private function setWindSpeed(string $windSpeed): void
	{
		$this->windSpeed = $windSpeed;
	}


	/**
	 * @param int $time
	 */
	private function setDate(int $time): void
	{
		$this->date = date('Y-m-d', $time);
	}

	/**
	 * @param int $time
	 */
	private function setTime(int $time): void
	{
		$this->time = date('H:i:s', $time);
	}

	/**
	 * @return string
	 */
	public function getDate(): string
	{
		return $this->date;
	}

	/**
	 * @return string
	 */
	public function getTime(): string
	{
		return $this->time;
	}

	/**
	 * @return int
	 */
	private function getSysTime()
	{
		return time();
	}

	/**
	 *
	 */
	private function setTimeRaw()
	{
		$this->timeRaw = $this->getSysTime();
	}
}