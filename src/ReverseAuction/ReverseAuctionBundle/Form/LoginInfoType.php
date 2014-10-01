<?php

namespace ReverseAuction\ReverseAuctionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginInfoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('userType')
            ->add('createdDate')
            ->add('updatedDate')
            ->add('UserInfo')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReverseAuction\ReverseAuctionBundle\Entity\LoginInfo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'reverseauction_reverseauctionbundle_logininfo';
    }
}
