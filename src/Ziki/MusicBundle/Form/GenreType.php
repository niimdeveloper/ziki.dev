<?php

namespace Ziki\MusicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GenreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('genre')
            ->add('description')
            ->add('tracks')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ziki\MusicBundle\Entity\Genre'
        ));
    }

    public function getName()
    {
        return 'ziki_musicbundle_genretype';
    }
}
