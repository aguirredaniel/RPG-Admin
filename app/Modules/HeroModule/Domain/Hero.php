<?php

namespace App\Modules\HeroModule\Domain;

use App\Modules\HeroModule\Domain\Classes\HeroClassStrategy;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroLastNameException;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroWeaponException;
use App\Modules\HeroModule\Domain\Races\HeroRaceStrategy;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroClassException;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroFirstNameException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hero extends Model
{

    use SoftDeletes;
    /**
     *
     * @var HeroRaceStrategy
     */
    public $heroRace;
    /**
     *
     * @var HeroClassStrategy
     */
    public $heroClass;

    /**
     * Define an array of properties for Mass Assignment.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'race',
        'class',
        'weapon',
        'strength',
        'intelligence',
        'dexterity'
    ];


    /**
     * Contains an array with errors of hero creation.
     *
     * @var array
     */
    public function setHeroRace(HeroRaceStrategy $heroRace)
    {
        $this->heroRace = $heroRace;
    }

    /**
     * Contains an array with errors of hero creation.
     *
     * @var array
     */
    public function setHeroClass(HeroClassStrategy $heroclass)
    {
        $this->heroClass = $heroclass;
    }

    /**
     * Command function to assign a valid name for its hero race.
     * @param string $name class for a hero.
     * @return void.
     * @throws InvalidHeroFirstNameException
     */
    public function setFirstNameAttribute($name)
    {
        try {
            $this->attributes['first_name'] = $this->heroRace->processFirstName($name);
        } catch (InvalidHeroFirstNameException $e) {
            throw $e;
        }
    }

    /**
     * Command function to assign a valid name for its hero race.
     * @param string $lastName class for a hero.
     * @return void.
     * @throws InvalidHeroLastNameException
     */
    public function setLastNameAttribute($lastName)
    {
        try {
            $this->attributes['last_name'] = $this->heroRace->processLastName($lastName);
        } catch (InvalidHeroLastNameException $e) {
            throw $e;
        }
    }

    /**
     * Command function to assign a valid class for its hero race.
     * @param HeroClass $class class for a hero.
     * @return void.
     * @throws InvalidHeroClassException
     */
    public function setClassAttribute($class)
    {
        if ($this->isValidClass($class))
            $this->attributes['class'] = $class;
        else
            throw new InvalidHeroClassException($class);
    }

    /**
     * Command function to assign a level.
     * @param int $level for a hero.
     * @return void.
     * @throws
     */
    public function setLevelAttribute($level)
    {
        $this->attributes['level'] = $level;
    }

    /**
     * Command function to assign a id for update model.
     * @param int $id for a hero.
     * @return void.
     * @throws
     */
    public function setIdAttribute($id)
    {
        $this->attributes['id'] = $id;
    }


    /**
     * Command function to assign a valid weapon for its hero class.
     * @param HeroClass $weapon for a hero.
     * @return void.
     * @throws InvalidHeroWeaponException
     */
    public function setWeaponAttribute($weapon)
    {
        if ($this->isValidWeapon($weapon))
            $this->attributes['weapon'] = $weapon;
        else
            throw new InvalidHeroWeaponException($weapon);
    }

    /**
     * Query function to check if a class is valid for its hero race.
     * @param HeroClass $class class for a hero.
     * @return boolean class it is valid.
     * @throws
     */
    private function isValidClass($class)
    {
        return in_array($class, $this->heroRace->getAvailableClass());
    }

    /**
     * Query function to check if a weapon is valid for its hero class.
     * @param HeroWeapons $weapon for a hero.
     * @return boolean weapon it is valid.
     * @throws
     */
    private function isValidWeapon($weapon)
    {
        return $weapon == HeroWeapons::Dagger ||
            in_array($weapon, $this->heroClass->getAvailableWeapons());
    }

    /**
     * Query function to check if hero need last name.
     * @param
     * @return boolean of hero need last name.
     * @throws
     */
    public function needLastName()
    {
        return $this->heroRace->needLastName();
    }
}
