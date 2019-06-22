<?php

namespace Tests\Unit\Modules\HeroModule\Races;

use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroClass;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroClassException;
use App\Modules\HeroModule\Domain\Races\HeroElf;
use PHPUnit\Framework\TestCase;

final class HeroElfTest extends TestCase
{
    protected $hero;

    /**
     * A set up test.
     * Create a hero, set Elf hero race
     * @return void
     */
    protected function setUp()
    {
        $heroElf = new HeroElf;
        $this->hero = new Hero;
        $this->hero->setHeroRace($heroElf);
    }

    /**
     * A test for name.
     * Elf has a reversed name.
     * @return void
     */
    public function testName()
    {
        $this->hero->first_name = 'Jimmy';

        $this->assertNotEquals($this->hero->first_name, 'Jimmy');
        $this->assertEquals($this->hero->first_name, 'Ymmij');
    }

    /**
     * A test for valid assignment class.
     * @return void
     */
    public function testValidClass()
    {
        $this->hero->class = HeroClass::Paladin;
        $this->assertEquals($this->hero->class, HeroClass::Paladin);

        $this->hero->class = HeroClass::Ranger;
        $this->assertEquals($this->hero->class, HeroClass::Ranger);

        $this->hero->class = HeroClass::Wizard;
        $this->assertEquals($this->hero->class, HeroClass::Wizard);
    }
    /**
     * A test for invalid assignment class.
     * Elf cannot be barbarian.
     * @return void
     */
    public function testElfCannotBeBarbarian()
    {
        $this->expectException(InvalidHeroClassException::class);
        $this->hero->class = HeroClass::Barbarian;
    }

    /**
     * A test for invalid assignment class.
     * Elf cannot be Warrior.
     * @return void
     */
    public function testElfCannotBeWarrior()
    {
        $this->expectException(InvalidHeroClassException::class);
        $this->hero->class = HeroClass::Warrior;
    }

}
