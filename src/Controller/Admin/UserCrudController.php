<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Doctrine\ORM\EntityManagerInterface;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email', 'Adresse email'),
            TextField::new('name', 'Nom'),
            TextareaField::new('bio', 'Biographie'),

            TextField::new('plainPassword', 'Mot de passe')
                ->onlyOnForms()
                ->setRequired($pageName === Crud::PAGE_NEW)
                ->hideWhenUpdating(),

            // Image upload avec VichUploader
            TextareaField::new('imageFile', 'Photo de profil')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            // Affichage image en mode index
            ImageField::new('imageName', 'Photo de profil')
                ->setBasePath('/uploads/images')
                ->onlyOnIndex(),

            // Affichage image en détail
            ImageField::new('imageName', 'Photo de profil')
                ->setBasePath('/uploads/images')
                ->onlyOnDetail(),

            // Relation ManyToMany avec Type
            AssociationField::new('types', 'Types')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->formatValue(function ($value, $entity) {
                    return implode(', ', $entity->getTypes()->map(fn($type) => $type->getName())->toArray());
                }),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof User && $entityInstance->getPlainPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPlainPassword());
            $entityInstance->setPassword($hashedPassword);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof User && $entityInstance->getPlainPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPlainPassword());
            $entityInstance->setPassword($hashedPassword);
        }

        parent::updateEntity($entityManager, $entityInstance);
    }
  
}
