<?php


namespace Tests\Unit\Modules\HeroModule\Classes;


use App\Modules\HeroModule\Domain\Classes\HeroBarbarian;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroWeaponException;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroWeapons;
use PHPUnit\Framework\TestCase;

class HeroBarbarianTest extends TestCase
{
    protected $hero;

    /**
     * A set up test.
     * Create a hero, set Barbarian hero class.
     * @return void
     */
    protected function setUp()
    {
        $heroRace = new HeroBarbarian;
        $this->hero = new Hero;
        $this->hero->setHeroClass($heroRace);
    }

    /**
     * A test to assign weapon.
     * Barbarian cannot use Bow and Arrows.
     * @return void
     */
    public function testBarbarianCannotUseBowAndArrows()
    {
        $this->expectException(InvalidHeroWeaponException::class);
        $this->hero->weapon = HeroWeapons::BowAndArrows;
    }

    /**
     * A test to assign weapon.
     * Barbarian cannot use Staffs.
     * @return void
     */
    public function testBarbarianCannotUseStaffs()
    {
        $this->expectException(InvalidHeroWeaponException::class);
        $this->hero->weapon = HeroWeapons::Staff;
    }

}
