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

    public function emptyCart(int $user_id)
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                DELETE FROM cart
                WHERE user_id = :user_id
            ';
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['user_id' => $user_id]);

        // $query = $this->createQuery(
        //     'DELETE App\Entity\Cart c
        //         WHERE C.user_id > :user_id'
        // )->setParameter('user_id', $user_id);

        // // returns an array of Product objects
        // return $query->execute();
    }
    
}
