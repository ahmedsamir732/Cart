<?php
namespace App\Cart\Add;

use App\Cart\Add\AddInterface;
use App\Entity\Cart;
use App\Cart\CheckQuantity;
use App\Cart\ErrorMessage;
use App\Entity\User;
use App\Entity\Product;

class Add implements AddInterface
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

	public function add(): bool
	{
		if (!$this->checkQuantity()) {
			return false;
		}

		$cart = new Cart();
		$cart->setProduct($this->product);
		$cart->setUser($this->user);
		$cart->setQuantity($this->quantity);

		$this->doctrineManager->persist($cart);
		$this->doctrineManager->flush();
		$this->id = $cart->getId();

		return ($this->id)? true: false;
	}

	public function getId()
	{
		return $this->id;
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