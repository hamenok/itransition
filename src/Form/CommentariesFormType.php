<?php

namespace App\Form;

use App\Entity\Commentaries;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentariesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr'=>[
                    'class' => 'form-control',
                    'minlength' => '5',
                    'maxlength' => '200',
                    'rows' => '2',
                    'placeholder' => 'Add your comment'
                    ]
            ]);
    }//class="form-control" minlength="5" maxlength="140" rows="2" placeholder="{% trans %}Add your comment{% endtrans %}"

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaries::class,
        ]);
    }
}
