<?php

namespace App\Cart\Edit;

use App\Cart\Edit\EditInterface;
use App\Entity\Cart;
use App\Cart\CheckQuantity;
use App\Cart\ErrorMessage;
use App\Entity\User;
use App\Entity\Product;

class Edit implements EditInterface
{

	use ErrorMessage;

	protected $doctrineManager;

	protected $user;

	protected $product;

	protected $quantity;

	protected $id;

	protected $errorMsg;

	public function __construct($doctrineManager)
	{
		$this->doctrineManager = $doctrineManager;
	}

	public function setProduct(Product $product)
	{
		$this->product = $product;
	}

	public function setUser(User $user)
	{
		$this->user = $user;
	}

	public function setQuantity(int $quantity)
	{
		$this->quantity = $quantity;
	}

	public function edit(Cart $cart): bool
	{
		if (!$this->checkQuantity()) {
			return false;
		}

		$cart->setQuantity($this->quantity);

		$this->doctrineManager->flush();

		return true;
		
	}

	protected function checkQuantity(): bool
	{
		$checkQuantity = new CheckQuantity();

		$response = $checkQuantity->check($this->quantity);

		if (!$response['status']) {
			$this->errorMsg = $response['error_msg'];
		}

		return $response['status']; 
	}

		public function getErrorMessage()
	{
		return $this->errorMsg;
	}

}