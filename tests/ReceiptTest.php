<?php
namespace TDD\Test;
require 'vendor\autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Receipt; // alusfail kasutamiseks

class ReceiptTest extends TestCase {
	public function setUp() {
		$this->Receipt = new Receipt(); // objekt on alles
	}

	public function tearDown() {
		unset($this->Receipt);
	}
	public function testTotal() {
		$input = [0,2,5,8];
		$output = $this->Receipt->total($input);
		$this->assertEquals(
			15,
			$output,
			'When summing the total should equal 15'
		);
	}

	public function testTax() { // uus funktsioon
		$inputAmount = 10.00;
		$taxInput = 0.10;
		$output = $this->Receipt->tax($inputAmount, $taxInput);
		$this->assertEquals(
			1.00,
			$output, // muutuja
			'The tax calculation should equal 1.00'
		);
	}
}