<?php

namespace Example;

use Everlution\EnumBundle\Form\EnumChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserType.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('gender', EnumChoiceType::class, [
            'enum_class' => Gender::class,
            // optional blacklisting: remove OTHER from form field choices
            'enum_blacklist' => [Gender::OTHER],
            // optional whitelisting: show only specified values
            'enum_whitelist' => [Gender::MALE, Gender::FEMALE],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
