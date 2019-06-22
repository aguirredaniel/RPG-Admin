<?php

namespace App\Modules\HeroModule\Domain\Races;

use App\Modules\HeroModule\Domain\HeroClass;

class HeroElf implements HeroRaceStrategy
{
    /**
     * Command function to process a name to a hero.
     * @param string $name name for a hero.
     * @return string.
     * @throws
     */
    public function processFirstName($name)
    {
        $elf_name = strrev($name);
        $elf_name[0] = strtoupper($elf_name[0]);
        $elf_name[strlen($elf_name) - 1] = strtolower($elf_name[strlen($elf_name) - 1]);

        return $elf_name;
    }

    /**
     * Command function to process a lastName to a hero.
     * @param string $lastName lastName for a hero.
     * @return string.
     * @throws
     */
    public function processLastName($lastName)
    {
        return $lastName;
    }

    /**
     * Query function to get available class hero.
     * @param
     * @return array of available class hero.
     * @throws
     */
    public function getAvailableClass()
    {
        return array_filter(
            HeroClass::getValues(),
            function ($heroClass) {
                return $heroClass != HeroClass::Warrior && $heroClass != HeroClass::Barbarian;
            }
        );
    }

    /**
     * Query function to check if hero need last name.
     * @param
     * @return boolean of hero need last name.
     * @throws
     */
    public function needLastName()
    {
        return true;
    }
}
