<?php

namespace Ziki\MusicBundle\Form;

use Ziki\MusicBundle\Entity\Artist;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('alias')
            ->add('type','choice', array(
			    'choices'   => array('Select a Type' => Artist::getTypes()),
			    'required'  => false,
			))
            ->add('file')
            ->add('location')
            ->add('description')
            //->add('albums', null, array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ziki\MusicBundle\Entity\Artist'
        ));
    }

    public function getName()
    {
        return 'ziki_musicbundle_artisttype';
    }
}
