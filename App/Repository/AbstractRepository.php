<?php

namespace App\Repository;

use Core\DataBinderInterface;
use DB\DatabaseInterface;

class AbstractRepository
{
	/**
	 * @var DatabaseInterface
	 */
	protected DatabaseInterface $db;

	/**
	 * @var DataBinderInterface
	 */
	protected DataBinderInterface $dataBinder;

	public function __construct(DatabaseInterface   $database,
	                            DataBinderInterface $dataBinder)
	{
		$this->db = $database;
		$this->dataBinder = $dataBinder;
	}
}