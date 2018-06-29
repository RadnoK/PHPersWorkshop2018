<?php

declare(strict_types=1);

namespace AppBundle\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuBuilder
{
    public function addProductSetsToMenu(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $menu
            ->getChild('catalog')
            ->addChild('product_set', ['route' => 'app_admin_product_set_index'])
            ->setLabel('Product Sets')
            ->setLabelAttribute('icon', 'cubes')
        ;
    }
}
