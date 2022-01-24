<?php

namespace App\Controller\Admin;

use App\Entity\Commentaries;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentariesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaries::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
