<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.12.18
 * Time: 21:15
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DefaultController extends AbstractController
{
    public function index()
    {
        $number = random_int(0, 100);

        return $this->render('base.html.twig', [
            'number' => $number,
        ]);
    }
}