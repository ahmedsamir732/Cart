<?php

namespace App\Cart;

use App\Entity\Product;

class CartExist
{

	protected $cartRepository;

	protected $cart;

	public function __construct($cartRepository)
	{
		$this->cartRepository = $cartRepository;
	}

	public function checkCart(int $user_id, int $product_id): bool
	{
		$items = $this->cartRepository->findByUserProduct($user_id, $product_id);	

		$this->cart = $items[0]?? null;

		return (count($items))? true: false;	
	}

	public function getCart()
	{
		return $this->cart;
	}
}