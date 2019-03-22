<?php

namespace App\Form;


use App\Entity\Instru;
use App\Entity\Style;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod("POST")
            ->add('instruments', EntityType::class, [
                'class' => Instru::class,
                'choice_label' => 'instruName',
                'mapped' => false,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Choisisez un instrument',
                //  'empty_data' => '',
                //'by_reference' => false,


            ]) //TODO check null when flushing into joinTable DB
//            ->add('styles', EntityType::class, [
//                'class' => Style::class,
//                'choice_label' => 'styleName',
//                'mapped' => false,
//                'multiple' => false,
//                'expanded' => false,
//                'placeholder' => 'Choisisez un style',
//                //'empty_data' => '',
//                //'by_reference' => false,
//
//            ])
//            ->add('groupe', ChoiceType::class, [
//                'choices' => [
//                    'Oui' => true,
//                    'Non' => false
//                ],
//                'expanded' => true,
//            ])

            //Child for submit button
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}