<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\Bundle\WishlistBundle\Model;

use SoerenMartius\Component\Wishlist\Model\Item as BaseItem;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 *
 * @Hateoas\Relation(
 *      "get",
 *      href = @Hateoas\Route(
 *          "sm_wishlist_item_show",
 *          parameters = { "wishlistId" = "expr(object.getWishlist().getId())", "id" = "expr(object.getId())"}
 *      )
 * )
 * @Hateoas\Relation(
 *      "put|patch",
 *      href = @Hateoas\Route(
 *          "sm_wishlist_item_edit",
 *          parameters = { "wishlistId" = "expr(object.getWishlist().getId())", "id" = "expr(object.getId())"}
 *      )
 * )
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "sm_wishlist_item_delete",
 *          parameters = { "wishlistId" = "expr(object.getWishlist().getId())", "id" = "expr(object.getId())"}
 *      )
 * )
 */
class Item extends BaseItem implements ItemInterface
{

    /**
     * @var mixed
     */
    private $productId;

    /**
     * {@inheritdoc}
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     *
     * @return ItemInterface
     */
    public function setProductId($productId) : ItemInterface
    {
        $this->productId = $productId;

        return $this;
    }
}
