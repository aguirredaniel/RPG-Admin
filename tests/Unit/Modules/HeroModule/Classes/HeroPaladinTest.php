<?php


namespace Tests\Unit\Modules\HeroModule\Classes;

use App\Modules\HeroModule\Domain\Classes\HeroPaladin;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroLastNameException;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroWeaponException;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroWeapons;
use PHPUnit\Framework\TestCase;

class HeroPaladinTest extends TestCase
{
    protected $hero;

    /**
     * A set up test.
     * Create a hero, set Paladin hero class.
     * @return void
     */
    protected function setUp()
    {
        $heroRace = new HeroPaladin();
        $this->hero = new Hero;
        $this->hero->setHeroClass($heroRace);
    }

    /**
     * A test to assign weapon.
     * Paladin can only use Swords.
     * @return void
     */
    public function testPaladinCanOnlyUseSwords(){
        $this->hero->weapon = HeroWeapons::Sword;
        $this->assertEquals(HeroWeapons::Sword, $this->hero->weapon);

        $this->expectException(InvalidHeroWeaponException::class);
        $this->hero->weapon = HeroWeapons::BowAndArrows;
    }
}
