<?php
namespace TDD\Test;
require 'vendor\autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Receipt; // alusfaili sees olev klass Receipt kasutamiseks siin koodis

class ReceiptTest extends TestCase { // laiendab TestCase klassi
	public function setUp() { // avalik meetod, siia saab ligi ka teistest klassidest
		$this->Receipt = new Receipt(); // teeme uue objekti nimega Receipt
	}

	public function tearDown() {
		unset($this->Receipt); // üks osa TestCase klassist
	}
	public function testTotal() {
		$input = [0,2,5,8]; // massiivi liikmed
		$coupon = null; // muutuja on väärtuseta
		$output = $this->Receipt->total($input, $coupon); // kutsutakse välja total meetod ja annab ette input-i ja coupon-i
		$this->assertEquals( // veendu et võrdub
			15, // oodatav tulemus
			$output, // see mis tuleb reaalselt
			'When summing the total should equal 15' // teade tuleb vea korral
		);
	}

	// uus funktsioon "testTotalAndCoupon", aga sarnane eelmisega
	public function testTotalAndCoupon() {
		$input = [0,2,5,8];
		$coupon = 0.20; // nüüd on väärtus olemas
		$output = $this->Receipt->total($input, $coupon);
		$this->assertEquals( // veendu et võrdub
			12, // oodatav tulemus
			$output, // see mis tuleb reaalselt
			'When summing the total should equal 12' // teade tuleb vea korral
		);
	}

	public function testTax() {
		$inputAmount = 10.00; // sisendväärtus
		$taxInput = 0.10; // kasu sisend
		$output = $this->Receipt->tax($inputAmount, $taxInput); // muutuja ja kutsume muutuja tax
		$this->assertEquals( // veendu et võrdub
			1.00, // oodatav tulemus
			$output, // see mis tuleb reaalselt
			'The tax calculation should equal 1.00' // teade tuleb vea korral
		);
	}
}