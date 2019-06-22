<?php


namespace Tests\Unit\Modules\HeroModule\Classes;

use App\Modules\HeroModule\Domain\Classes\HeroThief;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroWeaponException;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroWeapons;
use PHPUnit\Framework\TestCase;

class HeroThievesTest extends TestCase
{
    protected $hero;

    /**
     * A set up test.
     * Create a hero, set Thieves hero class.
     * @return void
     */
    protected function setUp()
    {
        $heroRace = new HeroThief;
        $this->hero = new Hero;
        $this->hero->setHeroClass($heroRace);
    }

    /**
     * A test to assign weapon.
     * Thieves cannot use Hammers.
     * @return void
     */
    public function testBarbarianCannotUseBowAndArrows()
    {
        $this->hero->weapon = HeroWeapons::Dagger;
        $this->assertEquals(HeroWeapons::Dagger, $this->hero->weapon);

        $this->hero->weapon = HeroWeapons::Sword;
        $this->assertEquals(HeroWeapons::Sword, $this->hero->weapon);


        $this->expectException(InvalidHeroWeaponException::class);
        $this->hero->weapon = HeroWeapons::Hammer;
    }

}
