<?php

namespace App\Controller\Admin;

use App\Entity\Tatoo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TatooCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tatoo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),

            TextField::new('tatoo', 'Nom du tatouage'),

            TextField::new('date', 'Date'),

            /* ---------- ASSOCIATION TATOUER / USER ---------- */
            
            AssociationField::new('user', 'Tatoueur')
                ->setRequired(true)                    
                ->setFormTypeOptions([
                    'choice_label' => 'name',          
                ]),

            /* ---------- UPLOAD & AFFICHAGE IMAGE ---------- */
        
            TextareaField::new('imageFile', 'Photo du tatouage')
                ->setFormType(VichImageType::class)
                ->onlyOnForms()
                ->setRequired(false),

            ImageField::new('imageName', 'Photo')
                ->setBasePath('/uploads/images')
                ->onlyOnIndex(),

            ImageField::new('imageName', 'Photo')
                ->setBasePath('/uploads/images')
                ->onlyOnDetail(),
        ];
    }
}
