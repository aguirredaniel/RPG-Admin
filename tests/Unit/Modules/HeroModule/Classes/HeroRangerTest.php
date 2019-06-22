<?php

namespace Tests\Unit\Modules\HeroModule\Classes;

use App\Modules\HeroModule\Domain\Classes\HeroRanger;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroWeaponException;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroWeapons;
use PHPUnit\Framework\TestCase;

class HeroRangerTest extends TestCase
{
    protected $hero;

    /**
     * A set up test.
     * Create a hero, set Ranger hero class.
     * @return void
     */
    protected function setUp()
    {
        $heroRace = new HeroRanger;
        $this->hero = new Hero;
        $this->hero->setHeroClass($heroRace);
    }

    /**
     * A test to assign weapon.
     * Ranger can only use Bow and Arrows.
     * @return void
     */
    public function testRangerCanOnlyUseBowAndArrows()
    {
        $this->hero->weapon = HeroWeapons::BowAndArrows;
        $this->assertEquals(HeroWeapons::BowAndArrows, $this->hero->weapon);

        $this->expectException(InvalidHeroWeaponException::class);
        $this->hero->weapon = HeroWeapons::Sword;
    }

}
