<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.02.19
 * Time: 18:14
 */

namespace App\Repository;

use App\Entity\Posts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PostsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Posts::class);
    }

    public function getByIds($ids) {
        return $this->createQueryBuilder('post')
            ->select()
            ->where('post.cat IN (:ids)')
            ->setParameter('ids', $ids);
    }
}