<?php


namespace Tests\Unit\Modules\HeroModule\Races;

use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroClassException;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroClass;
use App\Modules\HeroModule\Domain\Races\HeroHalfOrc;
use PHPUnit\Framework\TestCase;

class HeroHalfOrcTest extends TestCase
{
    protected $hero;

    /**
     * A set up test.
     * Create a hero, set HalfOrc hero race.
     * @return void
     */
    protected function setUp()
    {
        $heroClass = new HeroHalfOrc;
        $this->hero = new Hero;
        $this->hero->setHeroRace($heroClass);
    }

    /**
     * A test for last name.
     * HalfOrc don’t have a Last Name.
     * @return void
     */
    public function testHalfOrcDontHaveLastName()
    {
        $this->hero->last_name = 'Dhusher';
        $this->assertEquals($this->hero->last_name, null);
    }

    /**
     * A test for invalid assignment class.
     * HalfOrc cannot be a Wizard.
     * @return void
     */
    public function testHalfOrcCannotBeWizard()
    {
        $this->expectException(InvalidHeroClassException::class);
        $this->hero->class = HeroClass::Wizard;
    }

    /**
     * A test for invalid assignment class.
     * HalfOrc cannot be a Cleric.
     * @return void
     */
    public function testHalfOrcCannotBeCleric()
    {
        $this->expectException(InvalidHeroClassException::class);
        $this->hero->class = HeroClass::Cleric;
    }
}
