<?php

namespace App\Controller\Admin;

use App\Entity\Ultimate;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class UltimateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ultimate::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            TextEditorField::new('description'),
            AssociationField::new('characterName'),
            ImageField::new('imagePath'),
            TextField::new('ultLine'),
        ];
    }
    
}
