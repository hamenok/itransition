<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Role;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function(Action $action){
                return $action->setIcon('fa fa-user');
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

    public function configureCrud(Crud $crud):Crud 
    {
        return $crud
        ->overrideTemplate('crud/detail', 'admin/showUser.html.twig');
    }

    public function configureFilters(Filters $filters): filters
    {
        return $filters
        ->add('email')
        ->add('status', 'STATUS')
        ->add('roles')
        ->add('registerdate');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('avatar', 'USER AVATAR')
                ->setBasePath('images/users')
                ->setUploadDir('public/images/users')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),
            IdField::new('id', '#')->hideOnForm(),
            EmailField::new('email', 'EMAIL'),
            TextField::new('password', 'PASSWORD')->hideOnIndex(),
            TextField::new('firstname', 'FIRST NAME')->hideOnIndex(),
            TextField::new('lastname', 'LAST NAME')->hideOnIndex(),
            TelephoneField::new('phone', 'PHONE')->hideOnIndex(),
            BooleanField::new('status', 'ONLINE'),
            CollectionField::new('roles', 'ROLE'),
            DateTimeField::new('lastactivity', 'LAST ACTIVITY')->hideOnForm(),
            DateTimeField::new('registerdate', 'DATA REGISTRATION')->hideOnForm(),
            
           // CollectionField::new('roles')->ShowEntryLabel(true),

           
           // avatar;
            //culture;


        ];
    }
    
}
