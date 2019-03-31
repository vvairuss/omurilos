<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16.03.19
 * Time: 23:36
 */

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Posts;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Post
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        // TODO inject security component
    }

    public function check(string $path)
    {
        // TODO Change to cache search
        $result = $this->getPostsRepository()->findOneBy([
            'fullUrl' => $path
        ]);
        if($result === null) {
            throw new NotFoundHttpException('Posts ' . $path . ' was not fount');
        }
        return $result;
    }

    protected function getPostsRepository()
    {
        return $this->em->getRepository(Posts::class);
    }

    public function getPostsByCatIds(array $ids)
    {

    }

}