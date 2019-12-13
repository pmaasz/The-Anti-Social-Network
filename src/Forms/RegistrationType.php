<?php

namespace App\Forms;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RegistrationType
 *
 * @package App\Forms
 */
class RegistrationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,[
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Vorname'
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Name'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'E-Mail Adresse'
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Passwort'
                ]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}