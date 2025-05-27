<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Tatoo; // Ton entité

class TatooType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tatoo')
            ->add('date')
            ->add('imageFile') // ou selon ta config VichUploader ou autre
            // ajoute les champs nécessaires ici
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tatoo::class,
        ]);
    }
}
