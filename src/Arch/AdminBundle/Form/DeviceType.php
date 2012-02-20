<?php

namespace Arch\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DeviceType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('inv')
            ->add('room')
            ->add('producer')
            ->add('year')
            ->add('personal')
            ->add('hardware')
            ->add('software')
        ;
    }

    public function getName()
    {
        return 'arch_adminbundle_devicetype';
    }
}
