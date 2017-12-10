<?php
namespace App\Cart\Add;

use App\Entity\User;
use App\Entity\Product;

interface AddInterface
{

	public function __construct($doctrineManager);

	public function setProduct(Product $product);

	public function setUser(User $user);

	public function setQuantity(int $quantity);

	public function add(): bool;
}