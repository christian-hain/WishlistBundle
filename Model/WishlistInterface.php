<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\Bundle\WishlistBundle\Model;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
interface WishlistInterface
{
    /**
     * @return mixed
     */
    public function getCustomerId();
}
