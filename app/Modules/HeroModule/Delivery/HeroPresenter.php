<?php


namespace App\Modules\HeroModule\Delivery;


use App\Modules\HeroModule\Domain\Classes\HeroClassStrategy;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroClass;
use App\Modules\HeroModule\Domain\HeroRaces;
use App\Modules\HeroModule\Domain\HeroWeapons;
use App\Modules\HeroModule\Domain\Races\HeroRaceStrategy;
use App\Modules\HeroModule\HeroFactory;
use InvalidArgumentException;

class HeroPresenter
{
    /**
     * @param HeroRaces $race to present.
     * @return array represent JSon id and name for hero race.
     * @throws InvalidArgumentException
     */
    public static function presentHeroRace($race)
    {
        switch ($race) {
            case HeroRaces::Human:
                $name = 'Human';
                break;
            case HeroRaces::Elf:
                $name = 'Elf';
                break;
            case HeroRaces::Halfling:
                $name = 'Halfling';
                break;
            case HeroRaces::Dwarf:
                $name = 'Dwarf';
                break;
            case HeroRaces::HalfOrc:
                $name = 'HalfOrc';
                break;
            case HeroRaces::HalfElf:
                $name = 'HalfElf';
                break;
            case HeroRaces::Dragonborn:
                $name = 'Dragonborn';
                break;
            default:
                throw new InvalidArgumentException("Invalid race");
        }

        return ['id' => $race, 'name' => $name];
    }

    /**
     * @param HeroClass $class to present.
     * @return array represent JSon id and name for hero class.
     * @throws InvalidArgumentException
     */
    public static function presentHeroClass($class)
    {
        switch ($class) {
            case HeroClass::Paladin:
                $name = 'Paladin';
                break;
            case HeroClass::Ranger:
                $name = 'Ranger';
                break;
            case HeroClass::Barbarian:
                $name = 'Barbarian';
                break;
            case HeroClass::Wizard:
                $name = 'Wizard';
                break;
            case HeroClass::Cleric:
                $name = 'Cleric';
                break;
            case HeroClass::Warrior:
                $name = 'Warrior';
                break;
            case HeroClass::Thief:
                $name = 'Thief';
                break;
            default:
                throw new InvalidArgumentException("Invalid class");
        }

        return ['id' => $class, 'name' => $name];
    }

    /**
     * @param HeroWeapons $weapon to present.
     * @return array represent JSon id and name for hero weapon.
     * @throws InvalidArgumentException
     */
    public static function presentHeroWeapon($weapon)
    {
        switch ($weapon) {
            case HeroWeapons::Sword:
                $name = 'Sword';
                break;
            case HeroWeapons::Dagger:
                $name = 'Dagger';
                break;
            case HeroWeapons::Hammer:
                $name = 'Hammer';
                break;
            case HeroWeapons::BowAndArrows:
                $name = 'Bow and Arrows';
                break;
            case HeroWeapons::Staff:
                $name = 'Staff';
                break;
            default:
                throw new InvalidArgumentException("Invalid class");
        }

        return ['id' => $weapon, 'name' => $name];
    }

    /**
     * @param HeroRaceStrategy $heroRace to present.
     * @return array represent JSon of presentable class for a race.
     * @throws
     */
    public static function presentHeroRaceCreationRules($heroRace)
    {
        $presentableClass = array();
        foreach ($heroRace->getAvailableClass() as $class) {
            array_push($presentableClass, self::presentHeroClass($class));
        }

        return [
            'classes' => $presentableClass,
            'needLastName' => $heroRace->needLastName()
        ];
    }

    /**
     * @param HeroClassStrategy $heroClass to present.
     * @return array represent JSon of presentable weapons for a class.
     * @throws
     */
    public static function presentHeroClassCreationRules($heroClass)
    {
        $presentableWeapons = array();
        foreach ($heroClass->getAvailableWeapons() as $weapon) {
            array_push($presentableWeapons, self::presentHeroWeapon($weapon));
        }

        return $presentableWeapons;
    }


    public static function presentFirstNames()
    {
        return ['Bheizer', 'Khazun', 'Grirgel', 'Murgil', 'Edraf', 'En',
            'Grognur', 'Grum', 'Surhathion', 'Lamos',
            'Melmedjad', 'Shouthes', 'Che', 'Jun', 'Rircurtun', 'Zelen'];
    }

    public static function presentLastNames()
    {
        return ['Nema', 'Dhusher', 'Burningsun', 'Hawkglow', 'Nav', 'Kadev', 'Lightkeeper',
            'Heartdancer', 'Fivrithrit', 'Suechit', 'Tuldethatvo',
            'Vrovakya', 'Hiao', 'Chiay', 'Hogoscu', 'Vedrimor'
        ];
    }

    /**
     * @return array represent JSon of presentable races.
     * @throws
     */
    public static function presentHeroRaces()
    {
        $presentableRaces = array();
        foreach (HeroRaces::getValues() as $race) {
            array_push($presentableRaces, self::presentHeroRace($race));
        }

        return $presentableRaces;
    }

    /**
     * @param Hero $hero to present;
     * @return array represent JSon of presentable hero.
     * @throws
     */
    public static function presentHero($hero)
    {
        return [
            'id' => $hero->id,
            'first_name' => $hero->first_name,
            'last_name' => $hero->last_name,
            'race' => self::presentHeroRace($hero->race),
            'class' => self::presentHeroClass($hero->class),
            'weapon' => self::presentHeroWeapon($hero->weapon),
        ];
    }


    /**
     * @param Hero $hero to present;
     * @return array represent JSon of presentable hero for edition.
     * @throws
     */
    public static function presentHeroEditable($hero)
    {
        $heroRace = HeroFactory::makeHeroRace($hero->race);
        $heroClass = HeroFactory::makeHeroClass($hero->class);

        return [
            'id' => $hero->id,
            'first_name' => $hero->first_name,
            'last_name' => $hero->last_name,
            'race' => $hero->race,
            'class' => $hero->class,
            'weapon' => $hero->weapon,
            'strength' => $hero->strength,
            'intelligence' => $hero->intelligence,
            'dexterity' => $hero->dexterity,
            'needLastName' => $heroRace->needLastName(),
            'classes' => self::presentHeroRaceCreationRules($heroRace)['classes'],
            'weapons' => self::presentHeroClassCreationRules($heroClass)
        ];
    }
}
