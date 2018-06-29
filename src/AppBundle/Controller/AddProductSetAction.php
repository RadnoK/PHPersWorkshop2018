<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\ProductSet;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Component\Core\Factory\CartItemFactoryInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Order\Context\CartContextInterface;
use Sylius\Component\Order\Factory\OrderItemUnitFactoryInterface;
use Sylius\Component\Order\Modifier\OrderItemQuantityModifierInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;
use Sylius\Component\Order\Repository\OrderItemRepositoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AddProductSetAction
{
    /** @var CartContextInterface */
    private $cartContext;
    /** @var RepositoryInterface */
    private $productSetRepository;
    /** @var CartItemFactoryInterface */
    private $cartItemFactory;
    /**
     * @var OrderItemQuantityModifierInterface
     */
    private $itemQuantityModifier;
    /**
     * @var OrderProcessorInterface
     */
    private $orderProcessor;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(
        CartContextInterface $cartContext,
        RepositoryInterface $productSetRepository,
        CartItemFactoryInterface $cartItemFactory,
        OrderItemQuantityModifierInterface $itemQuantityModifier,
        OrderProcessorInterface $orderProcessor,
        ObjectManager $objectManager
    ) {
        $this->cartContext = $cartContext;
        $this->productSetRepository = $productSetRepository;
        $this->cartItemFactory = $cartItemFactory;
        $this->itemQuantityModifier = $itemQuantityModifier;
        $this->orderProcessor = $orderProcessor;
        $this->objectManager = $objectManager;
    }

    public function __invoke(Request $request): Response
    {
        $cart = $this->cartContext->getCart();
        /** @var ProductSet $productSet */
        $productSet = $this->productSetRepository->findOneBy([
            'code' => $request->request->get('productSetCode'),
        ]);

        $products = $productSet->getProducts();

        /** @var ProductInterface $product */
        foreach ($products as $product) {
            $cartItem = $this->cartItemFactory->createForCart($cart);
            $cartItem->setVariant($product->getVariants()->first());

            $this->itemQuantityModifier->modify($cartItem, 1);
        }

        $this->orderProcessor->process($cart);

        $this->objectManager->persist($cart);
        $this->objectManager->flush();

        return new RedirectResponse($request->headers->get('referer'));
    }
}
