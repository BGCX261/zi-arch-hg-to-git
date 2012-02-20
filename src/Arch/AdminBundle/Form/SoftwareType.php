<?php

namespace Arch\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SoftwareType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('year')
            ->add('license')
            ->add('softwareType')
        ;
    }

    public function getName()
    {
        return 'arch_adminbundle_softwaretype';
    }
}
