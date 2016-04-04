<?php

/*
 * (c) Soeren Martius
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoerenMartius\Bundle\WishlistBundle\Form\Type;

use Symfony\Component\Form\{ AbstractType, FormBuilderInterface };
use SoerenMartius\Bundle\WishlistBundle\Model\Wishlist;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Soeren Martius <soeren.martius@gmail.com>
 */
class WishlistFormType extends AbstractType
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
            ->add('customerId')
            ->add('sharingCode')
            ->add('items', CollectionType::class, [
                'entry_type' => ItemFormType::class,
                'allow_add'  => true
            ])
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
            'data_class'         => Wishlist::class,
            'csrf_protection'    => false,
            'allow_extra_fields' => true
        ]);
    }
}
