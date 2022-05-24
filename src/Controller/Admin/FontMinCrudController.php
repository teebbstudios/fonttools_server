<?php

namespace App\Controller\Admin;

use App\Entity\FontMin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FontMinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FontMin::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextareaField::new('text'),
            TextField::new('textHash'),
            TextField::new('fontFamily'),
            TextField::new('newFontFamily'),
            DateTimeField::new('createdAt')
            ,
        ];
    }
}
