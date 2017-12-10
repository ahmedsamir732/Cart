<?php
namespace App\Cart;

trait ErrorMessage
{

	public function generateErrorMessage(string $keyword = null)
	{
		$errorMsg = '';
		switch ($keyword) {
			case 'quantity_equal_to_zero':
				$errorMsg = 'Quantity Can not be zero';
				break;
			case 'quantity_more_than_max':
				$errorMsg = 'Quantity Can not be More than max value';
				break;
			case 'product_not_found':
				$errorMsg = 'You Should choose a product';
				break;
			// case 'quantity_more_than_max':
			// 	$errorMsg = 'Quantity Can not be More than max value';
			// 	break;
			
			default:
				$errorMsg = 'There is an error processing this to cart';
				break;
		}

		return $errorMsg;
	}
}