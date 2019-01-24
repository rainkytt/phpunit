<?php
namespace TDD;
class Receipt {
	public function total(array $items = []) {
		return array_sum($items); // summa items-sitest
	}

	public function tax($amount, $tax) { // teeme tax meetodi
		return ($amount * $tax); // tehe, mida teeb tax
	}
}