<?php
namespace TDD;
class Receipt {
	public function total(array $items = [], $coupon) { // lisame uue muutuja coupon
		$sum = array_sum($items); // summa arvutamine
		if (!is_null($coupon)) { // juhul kui couponil on väärtus olemas
			return $sum - ($sum * $coupon); // arvutusse lisame couponi
		}
		return $sum; // tagastame tulemuse kasutamiseks
	}

	public function tax($amount, $tax) { // teeme tax meetodi
		return ($amount * $tax); // tehe, mida teeb tax
	}
}