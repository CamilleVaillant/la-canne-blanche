<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Tatoo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TatooTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tatoo', TextType::class, [
        'label' => 'Nom du tatouage',
        'attr' => ['class' => 'form-control'],
    ])
            ->add('date',  TextType::class, [
        'attr' => ['class' => 'form-control'],
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
                'attr' => ['class' => 'form-control'],
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'mapped' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '4M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Veuillez upoader une image valide (JPEG, PNG, GIF, WEBP).',
                    ])
                ],
                'label' => 'Image (optionnelle)'
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
