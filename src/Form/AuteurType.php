<?php

namespace App\Form;
use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',  TextType::class, [
            'mapped' => false,
            'constraints' => [
                new Length([
                    'min' => 8,
                    'minMessage' => 'votre nom est de  {{ limit }} caractères minimum',
                    // max length allowed by Symfony for security reasons
                    'max' => 50,
                ]),
            ],

        ])
            ->add('lastname')
            ->add('age')
            ->add('pays')
            // this is the embeded form, the most important things are highlighted at the bottom
            ->add('prodcuts', CollectionType::class, [
                'entry_type' => ProductType::class,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                // this allows the creation of new forms and the prototype too
                'allow_add' => true,
                // self explanatory, this one allows the form to be removed
                'allow_delete' => true
            ])

            ->add('auteur', EntityType::class, [
                'placeholder' => 'selectionner un auteur',
                'mapped'  => 'false',
                'class' => Auteur::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'choice_label' => 'name',
                // self explanatory, this one allows the form to be removed
            ])
           ;
           
            $formModifier = function(FormInterface $form, Auteur $auteur) {
             $products = (null === $auteur) ? [] : $auteur->getProdcuts();

            $form ->add('produit', EntityType::class, [
                'placeholder' => 'selectionner un auteur',
                'class' => Product::class,
                'choices' => $products
             ]);
            
           };
           
           $builder->get('auteur')->addEvenListener(
              FormEvents::POST_SUBMIT,
               function(FormEvent $event) use ($formModifier) {
                   $event = $event->getForm()->getData();
               }
            )
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
