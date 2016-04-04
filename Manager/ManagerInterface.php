<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\Bundle\WishlistBundle\Manager;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
interface ManagerInterface
{
    /**
     * Returns the user's fully qualified class name.
     *
     * @return string
     */
    public function getClass(): string;
}
