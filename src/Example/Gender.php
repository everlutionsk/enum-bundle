<?php

namespace Example;

## Implementation
use Everlution\EnumBundle\Enum;

// always use `final`
final class Gender extends Enum
{
    const MALE = 1;
    const FEMALE = 2;
    const OTHER = 3;
    public static function getChoices(): array
    {
        return [
            'gender.male' => self::MALE,
            'gender.female' => self::FEMALE,
            'gender.other' => self::OTHER,
        ];
    }

    // following is optional
    public function isMale(): bool
    {
        return $this->isValue(self::MALE);
    }

    public function isFemale(): bool
    {
        return $this->isValue(self::FEMALE);
    }
}

# Usage
$male = new Gender(Gender::MALE);
var_dump($male->isMale()); // bool(true)
var_dump($male->isSameAs(new Gender(Gender::FEMALE))); // bool(false)
var_dump($male->isValue(Gender::FEMALE)); // bool(false)
echo $male->getValue(); // Gender::MALE
echo $male->getLabel(); // 'gender.male'
echo $male; // 'gender.male' (has __toString() implemented)

