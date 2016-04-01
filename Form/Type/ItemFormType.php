<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\WishlistBundle\Form\Type;

use Symfony\Component\Form\{ AbstractType, FormBuilderInterface };
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use SoerenMartius\WishlistBundle\Model\{ Item, Wishlist};

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
class ItemFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                 $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('wishlist', EntityType::class, [
                'class' => Wishlist::class
            ])
            ->add('productId')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => Item::class,
            'csrf_protection'    => false,
            'allow_extra_fields' => true
        ]);
    }
}
