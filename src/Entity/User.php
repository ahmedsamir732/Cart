<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

	/**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cart", mappedBy="user")
     */
    private $cartItems;

    public function __construct()
    {
    	$this->cartItems = new ArrayCollection();	
    }

    public function getCartItems()
    {
    	return $this->cartItems;
    }

    public function setName(string $name)
    {
    	$this->name = $name;
    }

    public function setEmail(string $email)
    {
    	$this->email = $email;
    }

    public function setPassword(string $password)
    {
    	$this->password = $password;
    }

    public function getId()
    {
    	return $this->id;
    }
}
