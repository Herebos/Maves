<?php

namespace App\Form;


use App\Entity\Style;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StyleType extends AbstractType
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
            ->add('style', EntityType::class, [
                'class' => Style::class,
                'mapped' => false,
                'choice_label' => 'styleName',
                'multiple' => true,
                'expanded' => true,
                'by_reference' =>false,


            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Style::class,
        ]);
    }
}