<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Category as CategoryService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repository\PostsRepository;

class CategoryController extends AbstractController
{
    private $CategoryService;
    private $PostsRepository;

    public function __construct(CategoryService $CategoryService, PostsRepository $PostsRepository)
    {
        $this->CategoryService = $CategoryService;
        $this->PostsRepository = $PostsRepository;
    }

    /**
     * Генерация страницы категорий постов
     *
     * @Route("/cat/{path}", name="category", requirements={"path"="[^.](\w+($|\/))+"})
     * @param $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($path)
    {
        // Проверка запрашиваемой категории на доступность
        try {
            $cat = $this->CategoryService->getByUrl($path);
        } catch (NotFoundHttpException $e) {
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig', [
                'path' => $path
            ]);
        }

        $menu = $this->CategoryService->getMenu();
        $childrenCats = $this->CategoryService->getChildrensIdById($cat->getId());


        $posts = $this->PostsRepository->getByIds($childrenCats)->getQuery()->getResult();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'path' => $path,
            'cat' => $cat
        ]);
    }
}
