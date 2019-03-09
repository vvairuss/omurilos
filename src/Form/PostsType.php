<?php

namespace App\Form;

use App\Entity\Posts;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cat',  EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'name',
//                'choice_value' => 'id'
            ])
            ->add('name')
            ->add('url')
            ->add('active')
            ->add('deleted')
            ->add('created')
            ->add('updated')
            ->add('startTime')
            ->add('endTime')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Posts::class,
        ]);
    }
}
