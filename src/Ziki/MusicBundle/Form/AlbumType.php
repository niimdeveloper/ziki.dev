<?php

namespace Ziki\MusicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('name')
            ->add('title')
            ->add('file')
            ->add('description')
            ->add('releasedAt')
            ->add('artists', null, array('required' => false)) //only testing
            ->add('tracks', null, array('required' => false)) //only testing perposes remove on ajax
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ziki\MusicBundle\Entity\Album'
        ));
    }

    public function getName()
    {
        return 'ziki_musicbundle_albumtype';
    }
}
