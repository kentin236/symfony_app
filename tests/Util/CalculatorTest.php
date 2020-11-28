<?php

namespace App\Tests\Util;

use App\Util\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
	public function testAdd(): void
	{
		$calculator = new Calculator();
		$result = $calculator->add(30, 12);
		self::assertEquals(42, $result);
	}
}