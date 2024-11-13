<?php

namespace App\Controller\Admin;

use App\Entity\Carrier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class CarrierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carrier::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Transporteur')
            ->setEntityLabelInPlural('Transporteurs');
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('name')->setLabel('Nom du transporteur'),
            TextareaField::new('description')->setLabel('Description du transporteur'), 
            NumberField::new('price')->setLabel('Prix TTC')->setHelp('Prix TTC du transporteur sans le cycle €.'),  
        ];
    }

}
