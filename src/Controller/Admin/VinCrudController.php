<?php

namespace App\Controller\Admin;

use App\Entity\Vin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vin::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nom'),
            IntegerField::new('prix'),
            IntegerField::new('quantitestock'),
            TextEditorField::new('description')->onlyOnForms(),
        ];
    }
    
}
