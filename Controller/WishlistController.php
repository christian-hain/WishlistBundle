<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\WishlistBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use SoerenMartius\Component\Wishlist\Model\Wishlist;
use SoerenMartius\WishlistBundle\Form\Type\WishlistFormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
class WishlistController extends FOSRestController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $wishlists = $this->get('sm_wishlist.manager.wishlist_manager')->findWishlistsBy([]);

        return $this->handleView(
            $this->view($wishlists)
        );
    }

    /**
     * @param $id
     *
     * @throws NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $wishlist = $this->get('sm_wishlist.manager.wishlist_manager')->findWishlistBy(
            [
                'id' => $id
            ]
        );

        if (! $wishlist) {
            throw new NotFoundHttpException('No wishlist found for id ' . $id);
        }

        return $this->handleView(
            $this->view($wishlist)
        );
    }

    /**
     * @param         $id
     * @param Request $request
     *
     * @throws NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Request $request)
    {
        $wishlist = $this->get('sm_wishlist.manager.wishlist_manager')->findWishlistBy(
            [
                'id' => $id
            ]
        );

        if (! $wishlist) {
            throw new NotFoundHttpException('No wishlist found for id' . $id);
        }

        $form = $this->getForm($wishlist);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $wishlist = $form->getData();

            $manager = $this->get('sm_wishlist.manager.wishlist_manager');
            $manager->updateWishlist($wishlist);

            return $this->handleView(
                $this->view($wishlist)
            );
        }

        return $this->handleView(
            $this->view($form)
        );
    }

    /**
     * Creates a new wishlist
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $form = $this->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $wishlist = $form->getData();

            $manager = $this->get('sm_wishlist.manager.wishlist_manager');
            $manager->updateWishlist($wishlist);

            return $this->handleView(
                $this->view($wishlist)
            );
        }

        return $this->handleView(
            $this->view($form)
        );
    }

    /**
     * Returns the wishlist form
     *
     * @param Wishlist|null $wishlist
     *
     * @return FormInterface
     */
    protected function getForm(Wishlist $wishlist = null): FormInterface
    {
        return $this->get('form.factory')->createNamed('', WishlistFormType::class, $wishlist);
    }
}
