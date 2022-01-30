<?php

namespace App\Form;

use App\Entity\ItemCollections;
use App\Entity\Category;
use App\Entity\Items;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ItemCollectionsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr'=>['class'=>'form-control']
            ])
            ->add('descriptions', TextareaType::class, [
                'attr'=>['class'=>'form-control']
            ])
            ->add('category', EntityType::class, [
                'class'=>Category::class,
                'attr'=>['class'=>'form-select'],
                'choice_label'=>'title'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'ADD COLLECTION'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemCollections::class,
        ]);
    }
}
