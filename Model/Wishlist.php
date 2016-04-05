<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\Bundle\WishlistBundle\Model;

use SoerenMartius\Component\Wishlist\Model\Wishlist as BaseWishlist;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 *
 * @Hateoas\Relation(
 *      "get",
 *      href = @Hateoas\Route(
 *          "sm_wishlist_show",
 *          parameters = { "id" = "expr(object.getId())" }
 *      )
 * )
 * @Hateoas\Relation(
 *      "put|patch",
 *      href = @Hateoas\Route(
 *          "sm_wishlist_edit",
 *          parameters = { "id" = "expr(object.getId())" }
 *      )
 * )
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "sm_wishlist_delete",
 *          parameters = { "id" = "expr(object.getId())" }
 *      )
 * )
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
