<?php
 namespace App\Cart;

 use App\Cart\ErrorMessage;

 class CheckQuantity
 {

 	use ErrorMessage;

 	public function check(int $quantity)
 	{
 		$response = ['status' => true, 'error_msg' => ''];
 		if ($quantity > 5) {
 			$response = ['status' => false, 'error_msg' => $this->generateErrorMessage('quantity_more_than_max')];
 		} elseif(!$quantity) {
 			$response = ['status' => false, 'error_msg' => $this->generateErrorMessage('quantity_equal_to_zero')];
 		}

 		return $response;

 	}
 }