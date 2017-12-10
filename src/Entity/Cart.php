<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Product;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="product")
     * @ORM\JoinColumn(nullable=true)
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function getUser(): User
    {
    	return $this->user;
    }

    public function setUser(user $user)
    {
    	$this->user = $user;
    }

    public function setProduct(Product $product)
    {
    	$this->product = $product;
    }

    public function getProduct(): Product
    {
    	return $this->product;
    }

    public function setQuantity(int $quantity)
    {
    	$this->quantity = $quantity;
    }

    public function getQuantity()
    {
    	return $this->quantity;
    }

    public function getId()
    {
    	return $this->id;
    }
    
}
