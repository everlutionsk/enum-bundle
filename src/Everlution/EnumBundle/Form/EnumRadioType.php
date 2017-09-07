<?php

declare(strict_types=1);

namespace Everlution\EnumBundle\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EnumRadioType.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class EnumRadioType extends EnumChoiceType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'expanded' => true,
        ]);
    }
}
