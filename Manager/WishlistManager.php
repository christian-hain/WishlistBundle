<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\WishlistBundle\Manager;

use SoerenMartius\WishlistBundle\Model\WishlistInterface;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
abstract class WishlistManager implements
    WishlistManagerInterface,
    ManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function findWishlistById($id)
    {
        return $this->findWishlistBy(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public function findWishlistBySharingCode(string $sharingCode)
    {
        return $this->findWishlistBy(['sharingCode' => $sharingCode]);
    }

    /**
     * {@inheritdoc}
     */
    public function createWishlist(): WishlistInterface
    {
        $class = $this->getClass();
        $wishlist = new $class;

        return $wishlist;
    }
}
