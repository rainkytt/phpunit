<?php
namespace TDD\Test;
require 'vendor\autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Receipt; // alusfail kasutamiseks

class ReceiptTest extends TestCase {
	public function testTotal() {
		$Receipt = new Receipt(); // klassist teeb objekti
		$this->assertEquals( // viitab TestCase-le
			15, // oodatud väärtus
			$Receipt->total([0,2,5,8]), // Receipt klassist pärit objekt, mis saab massiivi
			'When summing the total should equal 15' // kuvatakse kui ei tule oodatud väärtust
		);
	}
}