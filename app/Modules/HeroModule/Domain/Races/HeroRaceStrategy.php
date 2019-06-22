<?php

namespace App\Modules\HeroModule\Domain\Races;

use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroLastNameException;

/**
 * HeroRaceStrategy
 * Define a contract to implement the limitations for a hero depend in its Race
 */
interface HeroRaceStrategy
{
    /**
     * Command function to process a name to a hero.
     * @param string $name name for a hero.
     * @return string.
     * @throws InvalidHeroNameException
     */
    public function processFirstName($name);


    /**
     * Command function to process a lastName to a hero.
     * @param string $lastName lastName for a hero.
     * @return string.
     * @throws InvalidHeroLastNameException
     */
    public function processLastName($lastName);

    /**
     * Query function to get available class hero.
     * @param
     * @return array of available class hero.
     * @throws
     */
    public function getAvailableClass();

    /**
     * Query function to check if hero need last name.
     * @param
     * @return boolean of hero need last name.
     * @throws
     */
    public function needLastName();
}
