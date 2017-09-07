<?php

declare(strict_types=1);

namespace Everlution\EnumBundle\Form;

use Everlution\EnumBundle\EnumInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EnumChoiceType.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class EnumChoiceType extends ChoiceType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $enumClass = $options['enum_class'];

        // this checks that $enumClass implements EnumInterface
        $enumDataTransformer = new EnumDataTransformer($enumClass);

        /* @var EnumInterface $enumClass */
        $choices = $enumClass::getChoices();
        // whitelist
        if (is_array($options['enum_whitelist'])) {
            foreach ($choices as $label => $value) {
                if (!in_array($value, $options['enum_whitelist'])) {
                    unset($choices[$label]);
                }
            }
        }
        //blacklist
        $options['choices'] = array_diff($choices, (array) $options['enum_blacklist']);

        parent::buildForm($builder, $options);
        $builder->addModelTransformer($enumDataTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setRequired(['enum_class']);
        $resolver->setDefaults([
            'required' => false,
            'placeholder' => false,
            'enum_blacklist' => null,
            'enum_whitelist' => null,
        ]);
        $resolver->setAllowedTypes('enum_class', 'string');
        $resolver->setAllowedTypes('enum_blacklist', ['array', 'null']);
        $resolver->setAllowedTypes('enum_whitelist', ['array', 'null']);
    }
}
