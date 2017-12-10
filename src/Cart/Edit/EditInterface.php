<?php
namespace App\Cart\Edit;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\Cart;

interface EditInterface
{
	public function __construct($doctrineManager);

	public function setProduct(Product $product);

	public function setUser(User $user);

	public function setQuantity(int $quantity);

	public function edit(Cart $cart): bool;
}