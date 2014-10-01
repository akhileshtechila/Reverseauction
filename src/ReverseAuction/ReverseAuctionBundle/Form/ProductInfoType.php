<?php

namespace ReverseAuction\ReverseAuctionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductInfoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pName' ,'text', array(
                    'label' => '',
                    'required' => false
                ))
            ->add('pType' , 'text', array(
                    'label' => '',
                    'required' => false
                ))
            ->add('pBrandName', 'text', array(
                    'label' => '',
                    'required' => false
                ))
            ->add('pRetailPrize' ,'text', array(
                    'label' => '',
                    'required' => false
                ))
            ->add('file','file', array('label' => 'Image', 'data_class' => null, 'required' => false))
            ->add('pDescription' ,'textarea', array(
                    'label' => '',
                    'required' => false
                ))
            ->add('pBidExpiry')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'reverseauction_reverseauctionbundle_productinfo';
    }
}
