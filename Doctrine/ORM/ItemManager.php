<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\Bundle\WishlistBundle\Doctrine\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use SoerenMartius\Bundle\WishlistBundle\Manager\AbstractItemManager as BaseManager;
use SoerenMartius\Component\Wishlist\Model\ItemInterface;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
class ItemManager extends BaseManager
{
    /** @var ObjectManager */
    private $objectManager;

    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $repository;

    /** @var string */
    private $class;

    /**
     * ItemManager constructor.
     *
     * @param ObjectManager $objectManager
     * @param string        $class
     */
    public function __construct(ObjectManager $objectManager, string $class)
    {
        $this->objectManager = $objectManager;
        $this->repository    = $this->objectManager->getRepository($class);

        $metadata    = $objectManager->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * {@inheritdoc}
     */
    public function findItemBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findItemsBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * {@inheritdoc}
     */
    public function updateItem(ItemInterface $item)
    {
        $this->objectManager->persist($item);
        $this->objectManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteItem(ItemInterface $item)
    {
        $this->objectManager->refresh($item);
        $this->objectManager->flush();
    }


}
