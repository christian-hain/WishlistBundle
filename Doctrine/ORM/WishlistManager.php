<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\Bundle\WishlistBundle\Doctrine\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use SoerenMartius\Bundle\WishlistBundle\Manager\AbstractWishlistManager as BaseManager;
use SoerenMartius\Component\Wishlist\Model\WishlistInterface;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
class WishlistManager extends BaseManager
{
    /** @var ObjectManager */
    private $objectManager;

    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $repository;

    /** @var string */
    private $class;

    /**
     * WishlistManager constructor.
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
    public function findWishlistBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findWishlistsBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteWishlist(WishlistInterface $wishlist)
    {
        $this->objectManager->remove($wishlist);
        $this->objectManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function updateWishlist(WishlistInterface $wishlist)
    {
        $this->objectManager->persist($wishlist);
        $this->objectManager->flush();
    }
}
