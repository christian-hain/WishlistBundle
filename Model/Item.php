<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\Bundle\WishlistBundle\Model;

use SoerenMartius\Component\Wishlist\Model\Item as BaseItem;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
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
