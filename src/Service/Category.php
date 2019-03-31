<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16.03.19
 * Time: 23:36
 */

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categories;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Category
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        // TODO inject security component
    }

    public function getByUrl(string $path)
    {
        $cat = $this->getCatByUrl($path);
        $parentId = $cat->getParentId();
        if ($parentId && !$this->checkParents($parentId)) {
            throw new NotFoundHttpException('Category ' . $path . ' was not found');
        }
        return $cat;
    }

    public function getCatByUrl(string $path)
    {
        // TODO Change to cache search
        $result = $this->getCategoryRepository()->findOneBy([
            'fullUrl' => $path
        ]);
        if ($result === null) {
            throw new NotFoundHttpException('Category ' . $path . ' was not found');
        }

        return $result;
    }

    protected function getCategoryRepository()
    {
        return $this->em->getRepository(Categories::class);
    }

    /**
     * Рекурсивная проверка родителей на доступность
     * @param int $id
     * @return bool
     */
    private function checkParents(int $id): bool
    {
        $cat = $this->getCategoryRepository()->find($id);
        if ($cat === null || $cat->getDeleted() === 1) {
            return false;
        }
        // Самый верхний уровень, обрываем рекурсию
        if ($cat->getParentId() === 0) {
            return true;
        }
        return $this->checkParents($cat->getParentId());
    }

    /**
     * Объект полного меню по текущим правам пользователя
     * @return \stdClass
     */
    public function getMenu()
    {
        $tree = new \stdClass;

        $tree->childrens = $this->getChildrensIdById(0, false);

        return $tree;
    }

    /**
     * Рекурсивное получение потомков
     * оторванные
     * @param int $id
     * @return array
     */
    private function getChildrensByParentId(int $id): array
    {
        $arr = [];
        $cats = $this->getCategoryRepository()->findBy([
            'parentId' => $id
        ]);

        foreach ($cats as $cat) {
            // TODO inject security component
            if ($cat->getDeleted() === 1) {
                continue;
            }

            $tree = new \stdClass;

            $tree->cat = $cat;
            $childrens = $this->getChildrensByParentId($cat->getId());
            if (!empty($childrens)) {
                $tree->childrens = $childrens;
            }
            $arr[] = $tree;
        }

        return $arr;
    }

    public function getChildrensIdById(int $id, $include = true)
    {
        $childrens = $this->getChildrensByParentId($id);

        $arr = [];

        if ($include) {
            $arr[] = $id;
        }

        if (!empty($childrens)) {
            $arr = array_merge($arr, $this->convertToIds($childrens));
        }

        return $arr;
    }

    private function convertToIds(array $menu): array
    {
        $ids = [];

        foreach ($menu as $element) {
            $ids[] = $element->cat->getId();
            if (isset($element->childrens)) {
                $ids = array_merge($ids, $this->convertToIds($element->childrens));
            }
        }
        return $ids;
    }
}