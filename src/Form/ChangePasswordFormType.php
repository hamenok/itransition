<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'you.must.confirm.the.password.change',
                ]),
            ],
            'attr' => ['class' => 'form-check-input'],
            'label_attr' => [
                'class' => 'form-check-label',
            ],
        ])
        ->add('plainPassword', PasswordType::class, [

            'mapped' => false,
            'attr' => [
                'autocomplete' => 'new-password',
                'class' => 'form-control',
                'placeholder' => 'Password',
                'name' => 'password',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'please.enter.a.password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'your.password.should.be',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ])
        ->add('plainPasswordAgain', PasswordType::class, [

            'mapped' => false,
            'attr' => [
                'autocomplete' => 'new-password',
                'class' => 'form-control',
                'placeholder' => 'Password again',
                'name' => 'passwordAgain',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'please.enter.a.password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'your.password.should.be',
                    'max' => 4096,
                ]),
            ],
        ])
        ->add('save', SubmitType::class, [
            'row_attr' => [
                'class' => 'd-grid mt-5 mb-3',
            ],
            'attr' => [
                'class' => 'w-100 btn btn-lg btn-primary'
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // $resolver->setDefaults([
        //     'data_class' => User::class,
        // ]);
    }
}
