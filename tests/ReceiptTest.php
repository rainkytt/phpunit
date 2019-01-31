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

	/**
	 * @dataProvider provideTotal // kasutatakse testiandmeid, mille tagastab meetod provideTotal
	 */
	public function testTotal($items, $expected) { //
		$coupon = null; // muutuja on väärtuseta
		$output = $this->Receipt->total($items, $coupon); // kutsutakse välja total meetod ja annab ette items-i ja coupon-i
		$this->assertEquals( // veendu et võrdub
			$expected, // 
			$output, // see mis tuleb reaalselt
			'When summing the total should equal {$expected}' // teade tuleb vea korral
		);
	}

	public function provideTotal() { // andme edastus funktsioon koos etteantud väärtustega
		return [
			'ints totaling 16' => [[1,2,5,8], 16], // kokku 16
			[[-1,2,5,8], 14],
			[[1,2,8], 11],
		];
	}

	// uus funktsioon "testTotalAndCoupon", aga koos coupon-i väärtusega
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

	// kogu summale maksu õigesti lisamise kontroll-funktsioon koos Mock objektiga
	public function testPostTaxTotal() {
		$items = [1,2,5,8];
		$tax = 0.20;
		$coupon = null;
		$Receipt = $this->getMockBuilder('TDD\Receipt') // Receipt klassi alusel luuakse Mock objekt
			->setMethods(['tax', 'total']) // need meetodid lisatakse Mock objektile
			->getMock(); // Mock object omab Receipt objekti omadusi
		$Receipt->expects($this->once()) // meetod total kutsutakse välja üks kord
			->method('total') // Mock objekti meetod total
			->with($items, $coupon) // need on argumentideks
			->will($this->returnValue(10.00)); // ette antud suurus total=10
		$Receipt->expects($this->once()) // meetod tax kutsutakse välja üks kord
			->method('tax') // Mock objekti meetod tax
			->with(10.00, $tax) // koos väärtuse ja argumendiga
			->will($this->returnValue(1.00)); // ette antud suurus tax=1
		$result = $Receipt->postTaxTotal([1,2,5,8], 0.20, null); // mock objekti meetod koos argumentidega
		$this->assertEquals(11.00, $result); // selline, ehk 11, peab olema Mock objekti tulemus
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