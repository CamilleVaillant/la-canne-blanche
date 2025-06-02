<?php

// src/Form/TatooFilterTypeForm.php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class TatooFilterTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'Tous les tatoueurs',
                'label' => 'Tatoueur',
            ])
            ->add('order', ChoiceType::class, [
                'choices' => [
                    'Du plus récent au plus ancien' => 'desc',
                    'Du plus ancien au plus récent' => 'asc',
                ],
                'required' => false,
                'placeholder' => 'Ordre chronologique',
                'label' => 'Tri',
            ])
            ->add('filter', SubmitType::class, [
                'label' => 'Filtrer',
            ])
        ;
    }
}

