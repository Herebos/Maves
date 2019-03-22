<?php

namespace App\Form;


use App\Entity\Instru;
use App\Entity\Style;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        //Form Builder displayed in register twig
        $builder
            ->setMethod('POST')
            ->add('username')
            ->add('mail')
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                //'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractère',
                        // max length allowed by Symfony for security reasons is 4k
                        'max' => 100,
                    ]),
                ],
            ])
            ->add('instruments', EntityType::class, [
                'class' => Instru::class,
                'choice_label' => 'instruName',
                'mapped' => false,
                'multiple' => false,
                'expanded' => false,
                //  'empty_data' => '',
                //'by_reference' => false,


            ]) //TODO check null when flushing into joinTable DB
            ->add('styles', EntityType::class, [
                'class' => Style::class,
                'choice_label' => 'styleName',
                'mapped' => false,
                'multiple' => false,
                'expanded' => false,
                'empty_data' => '',
                //'by_reference' => false,

            ])
            ->add('groupe', ChoiceType::class, [
                'choices' => [
                        'Oui' => true,
                        'Non' => false
                ],
                'expanded' => true,

            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Please, just accept...'
                    ])
                ]
            ])

            //Child for submit button
            ->add('Inscription', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
