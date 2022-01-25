<?php

namespace App\Controller\Admin;

use App\Entity\Items;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ItemsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Items::class;
    }

    public function configureFilters(Filters $filters): filters
    {
        return $filters
        ->add('nameItem')
        ->add('tagItem')
        ->add('datecreateitem');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('imageItems', 'ITEM IMAGE')
                ->setBasePath('images/items')
                ->setUploadDir('public/images/items')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),
            IdField::new('id', '#')->hideOnForm(),
            TextField::new('nameItem', 'TITLE'),
            ArrayField::new('tagItem', 'TAGS'),
            IdField::new('author', 'AUTHOR'),
        
        ];
    }
    
    public function createEntity(string $entityFqcn)
    {
        $item = new Items();
        $item->setAuthor($this->getUser());

        return $item;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function(Action $action){
                return $action->setIcon('fa fa-tags');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function(Action $action){
                return $action->setIcon('fa fa-edit');
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function(Action $action){
                return $action->setIcon('fa fa-eye');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function(Action $action){
                return $action->setIcon('fa fa-trash');
            });
    }
}
