# EnumBundle
Enum in PHP with Symfony & Doctrine integration.

Allows for cleaner, object-oriented SRP code.

## Installation

`composer require everlutionsk/enum-bundle`

```php
$bundles = [
    new Everlution\EnumBundle\EnumBundle(),
]
```


## Implementation

#### Create new Enum
```php
<?php
// always use final
final class Gender extends Enum
{
    const MALE = 1;
    const FEMALE = 2;
    const OTHER = 3;
    public static function getChoices(): array
    {
        // 'string represtation' => self::constant
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
```

#### Use it!
PHP:
```php
<?php
$male = new Gender(Gender::MALE);
var_dump($male->isMale()); // bool(true)
var_dump($male->isSameAs(new Gender(Gender::FEMALE))); // bool(false)
var_dump($male->isValue(Gender::FEMALE)); // bool(false)
echo $male->getValue(); // Gender::MALE
echo $male->getLabel(); // 'gender.male'
echo $male; // 'gender.male' (has __toString() implemented)
```
Twig:
```twig
{{ gender|trans }}
```
#### Map Enum to database
In your app, create a service that's called **exactly** `enum.db_map` and make it implement `EnumDBMapInterface`.

Configuration in plain PHP is good for refactoring.

```php
<?php
/**
 * Class EnumDBMap.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class EnumDBMap implements EnumDBMapInterface
{
    public function getMap(): array
    {
        return [
            'enum_gender' => Gender::class,
            // 'enum_visibility' => Visibility::class, // and so on
        ];
    }
}
```

#### Use Enum in entities
```php
class User
{
    /**
     * @var Gender
     * @ORM\Column(type="enum_gender")
     */
    private $gender;

    /**
     * @return Gender
     */
    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    /**
     * @param Gender $gender
     * @return User
     */
    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

        return $this;
    }
}

## usage
$user = new User;
$user->setGender(new Gender(Gender::MALE));
```

#### Use Enum seamlessly in forms
```php
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
```

No DataTransformer needed to be explicitly declared.
It is already built-in in the form type.

`EnumRadioType` is also available.

Happy Enum-ing!
