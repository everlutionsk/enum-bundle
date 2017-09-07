<?php

namespace Example;

use Doctrine\ORM\Mapping as ORM;
/**
 * Class User.
 *
 * @ORM\Entity()
 * @author Richard Popelis <richard@popelis.sk>
 */
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
