<?php


namespace Tests\Unit\Modules\HeroModule\Classes;


use App\Modules\HeroModule\Domain\Classes\HeroWizard;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroWeaponException;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroWeapons;
use PHPUnit\Framework\TestCase;

class HeroWizardTest extends TestCase
{
    protected $hero;

    /**
     * A set up test.
     * Create a hero, set Wizard hero class.
     * @return void
     */
    protected function setUp()
    {
        $heroRace = new HeroWizard;
        $this->hero = new Hero;
        $this->hero->setHeroClass($heroRace);
    }

    /**
     * A test to assign weapon.
     * Wizard can only use Staffs.
     * @return void
     */
    public function testWizardCanOnlyUseStaffs(){
        $this->hero->weapon = HeroWeapons::Staff;
        $this->assertEquals(HeroWeapons::Staff, $this->hero->weapon);

        $this->expectException(InvalidHeroWeaponException::class);
        $this->hero->weapon = HeroWeapons::BowAndArrows;
    }
}
