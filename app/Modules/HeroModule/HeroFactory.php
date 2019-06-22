<?php


namespace App\Modules\HeroModule;


use App\Modules\HeroModule\Domain\Classes\HeroBarbarian;
use App\Modules\HeroModule\Domain\Classes\HeroClassStrategy;
use App\Modules\HeroModule\Domain\Classes\HeroCleric;
use App\Modules\HeroModule\Domain\Classes\HeroPaladin;
use App\Modules\HeroModule\Domain\Classes\HeroRanger;
use App\Modules\HeroModule\Domain\Classes\HeroThief;
use App\Modules\HeroModule\Domain\Classes\HeroWarrior;
use App\Modules\HeroModule\Domain\Classes\HeroWizard;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroClassException;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroFirstNameException;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroLastNameException;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroWeaponException;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroClass;
use App\Modules\HeroModule\Domain\HeroRaces;
use App\Modules\HeroModule\Domain\Races\HeroDragonborn;
use App\Modules\HeroModule\Domain\Races\HeroDwarf;
use App\Modules\HeroModule\Domain\Races\HeroElf;
use App\Modules\HeroModule\Domain\Races\HeroHalfElf;
use App\Modules\HeroModule\Domain\Races\HeroHalfling;
use App\Modules\HeroModule\Domain\Races\HeroHalfOrc;
use App\Modules\HeroModule\Domain\Races\HeroHuman;
use App\Modules\HeroModule\Domain\Races\HeroRaceStrategy;
use Particle\Validator\Validator;

use InvalidArgumentException;

class HeroCreationResult
{
    /**
     * Contains an array with errors of hero creation.
     *
     * @var array
     */
    public $errors = [];

    /**
     * Instances of Hero correctly created
     *
     * @var Hero
     */
    public $hero;

    /**
     * @param
     * @return boolean if the creation result has no errors (is valid).
     * @throws
     */
    public function isValid()
    {
        return sizeof($this->errors) == 0;
    }
}

class HeroFactory
{
    /**
     * @param array $heroData data represent request for hero creation.
     * @param Hero $hero variable where it store $heroData
     * @return HeroCreationResult.
     * @throws
     */
    public static function makeHero($heroData, $hero)
    {

        $heroCreationResult = new HeroCreationResult;
        $heroCreationResult->hero = $hero;

        $validator = new Validator;
        $validator->required('first_name');
        $validator->required('race')->greaterThan(0);
        $validator->required('class')->greaterThan(0);
        $validator->required('weapon')->greaterThan(0);
        $validator->required('strength')->greaterThan(0);
        $validator->required('intelligence')->greaterThan(0);
        $validator->required('dexterity')->greaterThan(0);

        $validationResult = $validator->validate($heroData);

        if ($validationResult->isNotValid()) {

            /**
             * Cleaner messages error of $validationResult.
             * Remove one level of attributes.
             */
            foreach ($validationResult->getMessages() as $key => $error) {
                foreach ($error as $messageError)
                    $heroCreationResult->errors[$key] = $messageError;
            }
            return $heroCreationResult;
        }

        try {
            $hero->race = $heroData['race'];
            $hero->setHeroRace(self::makeHeroRace($heroData['race']));

            if ($hero->needLastName() && (!isset($heroData['last_name']) || trim($heroData['last_name']) === '')) {
                $heroCreationResult->errors['last_name'] = 'last name must not be empty';
                return $heroCreationResult;
            }

            $hero->first_name = $heroData['first_name'];
            $hero->last_name = $heroData['last_name'];
            $hero->setHeroClass(self::makeHeroClass($heroData['class']));
            $hero->class = $heroData['class'];

            $hero->weapon = $heroData['weapon'];
            $hero->strength = $heroData['strength'];
            $hero->intelligence = $heroData['intelligence'];
            $hero->dexterity = $heroData['dexterity'];


        } catch (InvalidHeroFirstNameException $invalidHeroFirstName) {
            $heroCreationResult->errors['first_name'] = 'Is not valid first name.';
        } catch (InvalidHeroLastNameException $invalidHeroLastName) {
            $heroCreationResult->errors['last_name'] = 'Is not valid last name.';

        } catch (InvalidHeroClassException $invalidHeroClass) {
            $heroCreationResult->errors['class'] = 'Is not valid class.';

        } catch (InvalidHeroWeaponException $invalidHeroWeapon) {
            $heroCreationResult->errors['weapon'] = 'Is not valid weapon.';
        } finally {
            return $heroCreationResult;
        }

    }

    /**
     * @param HeroRaces $race assigned to a hero.
     * @return HeroRaceStrategy one of the possible implementations for hero race.
     * @throws InvalidArgumentException
     */
    public static function makeHeroRace($race)
    {
        switch ($race) {
            case HeroRaces::Human:
                return new HeroHuman;
            case HeroRaces::Elf:
                return new HeroElf;
            case HeroRaces::Halfling:
                return new HeroHalfling;
            case HeroRaces::Dwarf:
                return new HeroDwarf;
            case HeroRaces::HalfOrc:
                return new HeroHalfOrc;
            case HeroRaces::HalfElf:
                return new HeroHalfElf;
            case HeroRaces::Dragonborn:
                return new HeroDragonborn;
            default:
                throw new InvalidArgumentException("Invalid race");

        }
    }

    /**
     * @param HeroClass $class assigned to a hero.
     * @return HeroClassStrategy one of the possible implementations for hero class.
     * @throws InvalidArgumentException
     */
    public static function makeHeroClass($class)
    {
        switch ($class) {
            case HeroClass::Paladin:
                return new HeroPaladin;
            case HeroClass::Ranger:
                return new HeroRanger;
            case HeroClass::Barbarian:
                return new HeroBarbarian;
            case HeroClass::Wizard:
                return new HeroWizard;
            case HeroClass::Cleric:
                return new HeroCleric;
            case HeroClass::Warrior:
                return new HeroWarrior;
            case HeroClass::Thief:
                return new HeroThief;
            default:
                throw new InvalidArgumentException("Invalid class");
        }
    }
}
