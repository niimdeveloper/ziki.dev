<?php

namespace Ziki\MusicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TrackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('duration')
            ->add('genre', null, array('required' => 'false'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ziki\MusicBundle\Entity\Track'
        ));
    }

    public function getName()
    {
        return 'ziki_musicbundle_tracktype';
    }
}
