<?php

namespace App\VitrineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array(
                    'attr'=> array(
                        'class' => 'form-control'
                    )
            ))
            ->add('prenom', 'text', array(
                    'attr'=> array(
                        'class' => 'form-control'
                    )
            ))
            ->add('societe','text', array(
                    'attr'=> array(
                        'class' => 'form-control'
                    )
            ))
            ->add('email','text', array(
                    'attr'=> array(
                        'class' => 'form-control'
                    )
            ))
            ->add('message','textarea', array(
                    'attr'=> array(
                        'class' => 'form-control'
                    )
            ))
//            ->add('actif', 'checkbox', array(
//                'attr' => array(
//                    'checked' => 'checked'
//                )
//            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\VitrineBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_vitrinebundle_contact';
    }
}
