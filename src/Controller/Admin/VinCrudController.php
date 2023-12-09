<?php

namespace App\Controller\Admin;

use App\Entity\Vin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\Model\FileUploadState;
use Vich\UploaderBundle\Form\Type\VichImageType;

class VinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vin::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            NumberField::new('prix'),
            NumberField::new('quantitestock'),
            ImageField::new('vinImageName')
                ->onlyOnIndex()
                ->setBasePath('/images/vins'),
            TextareaField::new('vinImageFile')
                ->setFormType(VichImageType::class)
                ->hideOnIndex(),
            TextEditorField::new('description'),
        ];
    }
}
