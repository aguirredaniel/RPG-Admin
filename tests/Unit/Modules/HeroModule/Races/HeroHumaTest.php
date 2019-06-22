<?php

namespace Tests\Unit\Modules\HeroModule\Races;

use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroClassException;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroClass;
use App\Modules\HeroModule\Domain\Races\HeroHuman;
use PHPUnit\Framework\TestCase;

class HeroHumaTest extends TestCase
{
    protected $hero;

    /**
     * A set up test.
     * Create a hero, set Human hero race.
     * @return void
     */
    protected function setUp()
    {
        $heroClass = new HeroHuman;
        $this->hero = new Hero;
        $this->hero->setHeroRace($heroClass);
    }

    /**
     * A test for valid assignment class.
     * Humancan only be Paladin.
     * @return void
     */
    public function testHumanCanOnlyByPaladin()
    {
        $this->hero->class = HeroClass::Paladin;
        $this->assertEquals(HeroClass::Paladin, $this->hero->class);
    }

    /**
     * A test for invalid assignment class.
     * Human can only be Paladin.
     * @return void
     */
    public function tesHumanCannotBeRanger()
    {
        $this->expectException(InvalidHeroClassException::class);
        $this->hero->class = HeroClass::Ranger;
    }

}
