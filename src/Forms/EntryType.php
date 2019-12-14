<?php

namespace App\Forms;

use App\Entity\Entry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EntryType
 *
 * @author Philip Maass <pmaass@databay.de>
 */
class EntryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('body', TextareaType::class, [
                'required' => false,
                'attr' => ['class' => 'entry-textarea']
            ])
            ->add('media', FileType::class, [
                'required' => false,
                'attr' => ['class' => "media-input"]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults(["data_class" => Entry::class]);
    }
}