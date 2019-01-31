<?php
namespace TDD;

use \BadMethodCallException; // Kui tagasikutsumine viitab määratlemata meetodile või kui puuduvad mõned argumendid

class Receipt {
	public function total(array $items = [], $coupon) { // lisame uue muutuja coupon
		if ($coupon > 1.00) { // kontrollib, et coupon ei oleks ühest suurem ja kui on siis viskab järgmisel real oleva vea teate
			throw new BadMethodCallException('Coupon must be less than or equal to 1.00'); // teade kui on viga
		}
		$sum = array_sum($items); // summa arvutamine
		if (!is_null($coupon)) { // juhul kui couponil on väärtus olemas
			return $sum - ($sum * $coupon); // arvutusse lisame couponi
		}
		return $sum; // tagastame tulemuse kasutamiseks
	}

	public function tax($amount, $tax) { // teeme tax meetodi
		return ($amount * $tax); // tehe, mida teeb tax
	}

	public function postTaxTotal($items, $tax, $coupon) {
		$subtotal = $this->total($items, $coupon);
		return $subtotal + $this->tax($subtotal, $tax);
	}
}