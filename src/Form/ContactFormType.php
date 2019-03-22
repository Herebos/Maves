<?php

namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
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
            ->add('votreMail', EmailType::class)
            ->add('objet')
            ->add('message', TextareaType::class, [
                'attr' => ['placeholder' => 'Entrez votre texte (Pourquoi, où, qui...)']
            ]);
//            ->add('envoyer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}