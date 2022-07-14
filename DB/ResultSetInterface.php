<?php

namespace DB;

interface ResultSetInterface
{
	public function fetch($className = null) : \Generator;
}