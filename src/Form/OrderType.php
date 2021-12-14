<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nameProduct',  TextType::class, [
            'constraints' => [
                new Length([
                    'min' => 8,
                    'minMessage' => 'votre nom est de  {{ limit }} caractères minimum',
                    // max length allowed by Symfony for security reasons
                ]),
            ],

        ])
            ->add('nomProduct')
            ->add('date')
            ->add('adresse')
            ->add('numberId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
