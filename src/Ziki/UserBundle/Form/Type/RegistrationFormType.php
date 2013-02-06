<?php
/**
 * Touchwire Software 2010-2020
 * User: developer
 * Date: 2/4/13
 * Time: 5:03 PM
 * File: RegistrationFormType.php
 */
namespace Ziki\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('firstname')
                ->add('lastname');
    }

    public function getName()
    {
        return 'acme_user_registration';
    }
}

