<?php

namespace App\Controller\Admin;

use App\Entity\ItemCollections;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use App\Repository\CategoryRepository;

class ItemCollectionsCrudController extends AbstractCrudController
{

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public static function getEntityFqcn(): string
    {
        return ItemCollections::class;
    }

    public function configureFilters(Filters $filters): filters
    {
        return $filters
        ->add('title', 'TITLE')
        ->add('author', 'AUTHOR')
        ->add('descriptions', 'DESCRIPTIONS')
        ->add('category', 'CATEGORY');
    }

    public function createEntity(string $entityFqcn)
    {
        $Collection = new ItemCollections();
        $Collection->setAuthor($this->getUser());
        $Collection->setDatecreate(date_timezone_set(new \DateTime(), new \DateTimeZone('+3UTC')));

        return $Collection;
    }
    
    // public function configureFields(string $pageName): iterable
    // {
    //     $category[]="";
    //     $allCategory = $this->categoryRepository->getAllCategory();
    //     foreach ($allCategory as $key => $value)
    //     {
    //         $category[$value['title']] = $key;
    //     } 
        
       
    //     var_dump($category);
    
    //     return [
    //         TextField::new('title', 'FIRST NAME')
    //         ,
    //         TextField::new('category', 'CATEGORY')
               
    //     ];
    // }
    
}
