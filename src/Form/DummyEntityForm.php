<?php

namespace App\Form;

use App\Entity\DummyEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DummyEntityForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('myString', TextType::class, [
                'label' => 'string',
                'attr' => [
                    'placeholder' => 'saisir une string'
                ]
            ])
            ->add('myText', TextareaType::class)
            ->add('myBoolean', CheckboxType::class)
            ->add('myInteger', IntegerType::class)
            ->add('myFloat', NumberType::class)
            ->add('myArray')
            ->add('myJson')
            ->add('myObject', EntityType::class)
            ->add('myDatetime', DateTimeType::class)
            ->add('not_in_entity', PasswordType::class, [
                'label' => 'password confirm',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'confirm password'
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => "submit"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DummyEntity::class,
        ]);
    }
}
