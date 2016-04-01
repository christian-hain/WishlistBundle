<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\WishlistBundle\Doctrine\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use SoerenMartius\WishlistBundle\Manager\WishlistManager as BaseManager;
use SoerenMartius\WishlistBundle\Model\WishlistInterface;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
class WishlistManager extends BaseManager
{
    private $objectManager;

    private $repository;

    private $class;

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
    public function findWishlistsBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteWishlist(WishlistInterface $wishlist)
    {
        $this->objectManager->remove($wishlist);
        $this->objectManager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function updateWishlist(WishlistInterface $wishlist)
    {
        $this->objectManager->persist($wishlist);
        $this->objectManager->flush();
    }
}
