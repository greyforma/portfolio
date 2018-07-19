<?php

namespace App\Form;

use;

class PostType extends AbstractType
{
    Public function buildForm(FormBuilderInterface $Builder, array $options)
    {
        $Builder
            ->add('title', TextType::class)
            ->add('content', TextareaType::class)
            ->add('published',CheckboxType::class, ['required' => false])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ])
    }
}
