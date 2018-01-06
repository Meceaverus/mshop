<?php
/**
 * Created by PhpStorm.
 * User: Olf
 * Date: 06.01.2018
 * Time: 18:14
 */
namespace App\Service;

use App\Entity\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class Catalogue
{

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return Category[]|array
     */
    public function getCategories()
    {
        $repo = $this->em->getRepository(Category::class);

        return $repo->findAll();
    }

}