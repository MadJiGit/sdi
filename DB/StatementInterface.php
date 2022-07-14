<?php

namespace DB;

interface StatementInterface
{
	public function execute(array $params = []) : ResultSetInterface;
}