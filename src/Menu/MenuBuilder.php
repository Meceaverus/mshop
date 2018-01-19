<?php
/**
 * Created by PhpStorm.
 * User: Olf
 * Date: 07.01.2018
 * Time: 18:03
 */

namespace App\Menu;

use App\Service\Catalogue;
use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @var Catalogue
     */
    private $catalogueService;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, Catalogue $catalogue)
    {
        $this->factory = $factory;
        $this->catalogueService = $catalogue;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Главная', ['route' => 'homepage']);
        $catalogueMenu = $menu->addChild('Каталог', ['route' => 'categories_list']);
        $catalogueMenu->setExtra('dropdown', true);

        foreach ($this->catalogueService->getTopCategories() as $category){
            $catalogueMenu->addChild($category->getName(), ['route' => 'category_show',
            'routeParameters' => ['slug' => $category->getSlug()],
            ]);
        }

        $menu->addChild('Регистрация', ['route' => 'fos_user_registration_register']);

        return $menu;
    }
}