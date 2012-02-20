<?php

namespace Arch\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class HardwareType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('hardwareType')
        ;
    }

    public function getName()
    {
        return 'arch_adminbundle_hardwaretype';
    }
}
