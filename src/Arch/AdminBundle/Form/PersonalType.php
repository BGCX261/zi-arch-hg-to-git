<?php

namespace Arch\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PersonalType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $now = new \DateTime();
        $year = $now->format('Y');
        $builder
            ->add('pib')
            ->add('birthday', null, array('years' => range(1930, $year)))
            ->add('department', null, array('attr' => array('class' => 'chzn')))
            ->add('position')
        ;
    }

    public function getName()
    {
        return 'arch_adminbundle_personaltype';
    }
}
