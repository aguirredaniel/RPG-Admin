<?php


namespace Tests\Unit\Modules\HeroModule\Races;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroClassException;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroClass;
use App\Modules\HeroModule\Domain\Races\HeroHalfling;
use PHPUnit\Framework\TestCase;

class HalflingTest extends TestCase
{
    protected $hero;

    /**
     * A set up test.
     * Create a hero, set Halfling hero race.
     * @return void
     */
    protected function setUp()
    {
        $heroClass = new HeroHalfling;
        $this->hero = new Hero;
        $this->hero->setHeroRace($heroClass);
    }

    /**
     * A test for invalid assignment class.
     * Halfling cannot only be Barbarian.
     * @return void
     */
    public function testHalflingCannotBeBarbarian()
    {
        $this->expectException(InvalidHeroClassException::class);
        $this->hero->class = HeroClass::Barbarian;
    }
}
