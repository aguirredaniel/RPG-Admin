<?php


namespace Tests\Unit\Modules\HeroModule\Races;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroClassException;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroClass;
use App\Modules\HeroModule\Domain\Races\HeroHalfElf;
use PHPUnit\Framework\TestCase;

class HeroHalfElfTest extends TestCase
{
    protected $hero;

    /**
     * A set up test.
     * Create a hero, set HalfOrc hero race.
     * @return void
     */
    protected function setUp()
    {
        $heroClass = new HeroHalfElf;
        $this->hero = new Hero;
        $this->hero->setHeroRace($heroClass);
    }

    /**
     * A test for valid assignment class.
     * HalfOrc can only be Paladin.
     * @return void
     */
    public function testHumanCanOnlyByPaladin()
    {
        $this->hero->class = HeroClass::Paladin;
        $this->assertEquals(HeroClass::Paladin, $this->hero->class);


        $this->expectException(InvalidHeroClassException::class);
        $this->hero->class = HeroClass::Ranger;
    }
}
