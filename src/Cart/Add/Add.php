<?php
namespace App\Cart\Add;

use App\Cart\Add\AddInterface;
use App\Entity\Cart;
use App\Cart\CheckQuantity;
use App\Cart\ErrorMessage;
use App\Entity\User;
use App\Entity\Product;
use App\Cart\Edit\Edit;
use App\Cart\CartExist;

class Add implements AddInterface
{

	use ErrorMessage;

	protected $doctrineManager;

	protected $user;

	protected $product;

	protected $quantity = 0;

	protected $id;

	protected $errorMsg = '';

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
		$cart = $this->checkExist($this->user->getId(), $this->product->getId());
		if($cart) {
			return $this->callEdit($cart);
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

	protected function checkExist($user_id, $product_id)
	{
		$cart = null;
		$CartExist = new CartExist($this->doctrineManager->getRepository(Cart::class));
		if($CartExist->checkCart($user_id, $product_id)) {
			$cart = $CartExist->getCart();
		}

		return $cart;
	}

	public function getErrorMessage()
	{
		return $this->errorMsg;
	}

	public function callEdit(Cart $cart)
	{
		$editCart = new Edit($this->doctrineManager);
		$editCart->setQuantity($this->quantity + $cart->getQuantity());
		$status = $editCart->edit($cart);
		if (!$status) {
			$this->errorMsg = $editCart->getErrorMessage();
		}

		return $status;
	}


}