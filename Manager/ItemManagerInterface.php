<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\Bundle\WishlistBundle\Manager;

use SoerenMartius\Component\Wishlist\Model\ItemInterface;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
interface ItemManagerInterface
{
    /**
     * @param array      $criteria
     * @param array|null $orderBy
     * @param null       $limit
     * @param null       $offset
     *
     * @return ItemInterface[]|null
     */
    public function findItemsBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param array $criteria
     *
     * @return ItemInterface|null
     */
    public function findItemBy(array $criteria);

    /**
     * @param mixed $id
     *
     * @return ItemInterface|null
     */
    public function findItemById($id);

    /**
     * @return ItemInterface
     */
    public function createItem(): ItemInterface;

    /**
     * @param ItemInterface $item
     *
     * @return void
     */
    public function updateItem(ItemInterface $item);

    /**
     * @param ItemInterface $item
     *
     * @return void
     */
    public function deleteItem(ItemInterface $item);

    /**
     * @return string
     */
    public function getClass(): string;
}
