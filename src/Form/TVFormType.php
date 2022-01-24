<?php

namespace App\Form;

use App\Entity\TV;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\GreaterThan;

class TVFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('mark')
        ->add('model')
        ->add('size', IntegerType::class, [
            'constraints' => [
                new GreaterThan([
                    'value' => 15,
                    'message' => 'Your size of screen should be at least {{ compared_value }}"',
                ]),
                new LessThan([
                    'value' => 100,
                    'message' => 'Your size of screen more than {{ compared_value }}"',
                ]),
            ],
        ])
        ->add('smarttv', CheckboxType::class, [
            'label' => 'Have a SmartTV?',
            'required' => false
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Add TV'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TV::class,
        ]);
    }
}
