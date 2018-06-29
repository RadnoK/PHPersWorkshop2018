<?php

declare(strict_types=1);

namespace AppBundle\Form\Type;

use Sylius\Bundle\ProductBundle\Form\Type\ProductAutocompleteChoiceType;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductSetType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('products', ProductAutocompleteChoiceType::class, [
                'multiple' => true,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_set';
    }
}
