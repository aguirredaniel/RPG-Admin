<?php


namespace Tests\Unit\Modules\HeroModule\Races;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroClassException;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroFirstNameException;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroLastNameException;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroClass;
use App\Modules\HeroModule\Domain\Races\HeroDwarf;
use PHPUnit\Framework\TestCase;


class HeroDwarfTest extends TestCase
{
    protected $hero;

    /**
     * A set up test.
     * Create a hero, set Dwarf hero race.
     * @return void
     */
    protected function setUp()
    {
        $heroClass = new HeroDwarf;
        $this->hero = new Hero;
        $this->hero->setHeroRace($heroClass);
    }

    /**
     * A test for name.
     * Bheizer is valid first name for Dwarf hero race.
     * Dwarf first name must contain at least an “R” or an “H”
     * @return void
     */
    public function testValidFirtName()
    {
        $this->hero->first_name = 'Bheizer';
        $this->assertEquals($this->hero->first_name, 'Bheizer');
    }

    /**
     * A test for last name.
     * Bheizer is valid name for Dwarf hero race.
     * Dwarf last  name must contain at least an “R” or an “H”
     * @return void
     */
    public function testValidLastName()
    {
        $this->hero->last_name = 'Dhusher';
        $this->assertEquals($this->hero->last_name, 'Dhusher');
    }

    /**
     * A test for name.
     * Jimmy is invalid name for Dwarf hero race.
     * @return void
     */
    public function testInvalidName(){
        $this->expectException(InvalidHeroFirstNameException::class);
        $this->hero->first_name = 'Jimmy';
    }

    /**
     * A test for name.
     * Jimmy is invalid last name for Dwarf hero race.
     * @return void
     */
    public function testInvalidLastName(){
        $this->expectException(InvalidHeroLastNameException::class);
        $this->hero->last_name = 'Nema';
    }

    /**
     * A test for invalid assignment class.
     * Ranger class is invalid class for Dwarf hero race.
     * @return void
     */
    public function testDwarfCannottBeRanger()
    {
        $this->expectException(InvalidHeroClassException::class);
        $this->hero->class = HeroClass::Ranger;
    }

    /**
     * A test for invalid assignment class.
     * Wizard class is invalid class for Dwarf hero race.
     * @return void
     */
    public function testDwarfCannotBeWizard()
    {
        $this->expectException(InvalidHeroClassException::class);
        $this->hero->class = HeroClass::Wizard;
    }
}
