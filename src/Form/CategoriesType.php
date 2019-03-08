<?php

namespace App\Form;

use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentId')
            ->add('name')
            ->add('url')
            ->add('fullUrl')
            ->add('title')
            ->add('description')
            ->add('meta')
            ->add('keywords')
            ->add('active')
            ->add('created',DateTimeType::class, [
                'disabled' => true,
                'date_widget' => 'single_text',
                'html5' => false
            ])
            ->add('deleted')
            ->add('topMenu')
            ->add('siteMap')
            ->add('startTime')
            ->add('endTime')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
