<?php

namespace DB;

class PDOPreparedStatement implements StatementInterface
{
	/**
	 * @var \PDOStatement
	 */
	private \PDOStatement $pdoStatement;

	/**
	 * @param \PDOStatement $pdoStatement
	 */
	public function __construct(\PDOStatement $pdoStatement)
	{
		$this->pdoStatement = $pdoStatement;
	}

	public function execute(array $params = []): ResultSetInterface
	{
		$this->pdoStatement->execute($params);
		return new PDOResultSet($this->pdoStatement);
	}
}