<?php

namespace App\Form;

use App\Entity\CollectionsFull;
use App\Entity\ItemCollections;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CollectionsFullFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('collectionID', EntityType::class, [
                'class'=>ItemCollections::class,
                'attr'=>['class'=>'form-select'],
                'choice_label'=>'title'
            ])
            ->add('add',  SubmitType::class, [
                'label' => 'ADD TO COLLECTION'
            ])
            // ->add('userID')
            // ->add('itemID')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CollectionsFull::class,
        ]);
    }
}
