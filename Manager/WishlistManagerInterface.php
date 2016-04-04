<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\WishlistBundle\Manager;

use SoerenMartius\Component\Wishlist\Model\WishlistInterface;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
interface WishlistManagerInterface
{
    /**
     * @param array      $criteria
     * @param array|null $orderBy
     * @param null       $limit
     * @param null       $offset
     *
     * @return WishlistInterface[]|null
     */
    public function findWishlistsBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param array $criteria
     *
     * @return WishlistInterface|null
     */
    public function findWishlistBy(array $criteria);

    /**
     * @param mixed $id
     *
     * @return WishlistInterface|null
     */
    public function findWishlistById($id);

    /**
     * @param string $sharingCode
     *
     * @return WishlistInterface|null
     */
    public function findWishlistBySharingCode(string $sharingCode);

    /**
     * @return WishlistInterface
     */
    public function createWishlist(): WishlistInterface;

    /**
     * @param WishlistInterface $wishlist
     *
     * @return void
     */
    public function deleteWishlist(WishlistInterface $wishlist);

    /**
     * @param WishlistInterface $wishlist
     *
     * @return void
     */
    public function updateWishlist(WishlistInterface $wishlist);

    /**
     * @return string
     */
    public function getClass(): string;
}
