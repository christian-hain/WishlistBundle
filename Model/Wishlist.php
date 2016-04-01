<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\WishlistBundle\Model;

use SoerenMartius\Component\Wishlist\Model\Wishlist as BaseWishlist;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
class Wishlist extends BaseWishlist implements WishlistInterface
{
    /**
     * @var mixed
     */
    private $customerId;

    /**
     * {@inheritdoc}
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     *
     * @return WishlistInterface
     */
    public function setCustomerId($customerId): WishlistInterface
    {
        $this->customerId = $customerId;

        return $this;
    }
}
