<?php
namespace TDD\Test;
require 'vendor\autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Receipt; // alusfail kasutamiseks

class ReceiptTest extends TestCase {
	public function setUp() { // funktsioonid, mis pannakse tööle enne igat testmeeetodi väljakutsumist
		$this->Receipt = new Receipt(); // teeb klassist objekti
	}

	public function tearDown() { // funktsioonid, mis pannakse tööle enne igat testmeeetodi väljakutsumist
		unset($this->Receipt); // et ühest testist ei kantaks midagi üle teise, s.t tühjendab mälust
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
}