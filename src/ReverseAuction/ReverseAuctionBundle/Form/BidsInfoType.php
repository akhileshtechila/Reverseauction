<?php

namespace ReverseAuction\ReverseAuctionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BidsInfoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('UserInfo','entity', array(
                    'class' => 'ReverseAuction\ReverseAuctionBundle\Entity\UserInfo',
                    'property' => 'email',
                    'required' => true,
                    'empty_value' => 'Choose an option',
                ))
            ->add('ProductInfo','entity', array(
                    'class' => 'ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo',
                    'property' => 'pName',
                    'required' => true,
                    'empty_value' => 'Choose an option',
                ))
            ->add('bUserName','text',array( 'required' => true ))
            ->add('bEmail','text',array( 'required' => true ))
            ->add('bProductName','text',array( 'required' => true ))
            ->add('bAmount','text',array( 'required' => true ))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'reverseauction_reverseauctionbundle_bidsinfo';
    }
}
