<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CartRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    
    public function findByUserProduct(int $user_id, int $product_id)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.product = :product_id')
            ->andWhere('c.user = :user_id')
            ->setParameter('user_id', $user_id)
            ->setParameter('product_id', $product_id)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }
    
}
