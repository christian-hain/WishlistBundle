<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\Bundle\WishlistBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use SoerenMartius\Component\Wishlist\Model\ItemInterface;
use SoerenMartius\Bundle\WishlistBundle\Form\Type\ItemFormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
class ItemController extends FOSRestController
{
    /**
     * @param mixed $wishlistId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($wishlistId)
    {
        $wishlist = $this->get('sm_wishlist.manager.wishlist_manager')->findWishlistById($wishlistId);

        if (! $wishlist) {
            throw new NotFoundHttpException('No wishlist found for id ' . $wishlistId);
        }

        $items = $this->get('sm_wishlist.manager.item_manager')->findItemsBy(['wishlist' => $wishlistId]);

        return $this->handleView(
            $this->view($items)
        );
    }

    /**
     * @param mixed $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $item = $this->get('sm_wishlist.manager.item_manager')->findItemById($id);

        if (! $item) {
            throw new NotFoundHttpException('No item found for id ' . $id);
        }

        return $this->handleView(
            $this->view($item)
        );
    }

    /**
     * @param mixed   $wishlistId
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction($wishlistId, Request $request)
    {
        $wishlist = $this->get('sm_wishlist.manager.wishlist_manager')->findWishlistById($wishlistId);

        if (! $wishlist) {
            throw new NotFoundHttpException('No wishlist found for id ' . $wishlistId);
        }

        $form = $this->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $item = $form->getData();

            $manager = $this->get('sm_wishlist.manager.item_manager');
            $manager->updateItem($item);

            return $this->handleView(
                $this->view($item)
            );
        }

        return $this->handleView(
            $this->view($form)
        );
    }

    /**
     * @param         $wishlistId
     * @param         $itemId
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($wishlistId, $itemId, Request $request)
    {
        $wishlist = $this->get('sm_wishlist.manager.wishlist_manager')->findWishlistById($wishlistId);
        if (! $wishlist) {
            throw new NotFoundHttpException('No wishlist found for id ' . $wishlistId);
        }

        $item = $this->get('sm_wishlist.manager.item_manager')->findItemById($itemId);
        if (! $item) {
            throw new NotFoundHttpException('No item found for id ' . $itemId);
        }

        $form = $this->getForm($item, ['method' => $request->getMethod()]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $item = $form->getData();

            $manager = $this->get('sm_wishlist.manager.item_manager');
            $manager->updateItem($item);

            return $this->handleView(
                $this->view($item)
            );
        }

        return $this->handleView(
            $this->view($form)
        );
    }

    /**
     * @param ItemInterface|null $item
     * @param array              $options
     *
     * @return FormInterface
     */
    protected function getForm(ItemInterface $item = null, array $options = []): FormInterface
    {
        return $this->get('form.factory')->createNamed('', ItemFormType::class, $item, $options);
    }
}
