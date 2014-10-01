<?php

namespace ReverseAuction\ReverseAuctionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserInfoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fName')
            ->add('lName')
            ->add('email')
            ->add('state')
            ->add('country')
            ->add('zipCode')
            ->add('mobile')
            ->add('userType')
            ->add('createdDate')
            ->add('updatedDate')
            ->add('LoginInfo')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReverseAuction\ReverseAuctionBundle\Entity\UserInfo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'reverseauction_reverseauctionbundle_userinfo';
    }
}
