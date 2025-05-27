<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Tatoo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TatooTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tatoo')
            ->add('date')
            ->add('imageName')
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('User', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => false,
                'download_uri' => false,
                'label' => 'Image du tatouage',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tatoo::class,
        ]);
    }
}
