<?php

namespace Tests\Unit\Modules\HeroModule;

use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroClass;
use App\Modules\HeroModule\Domain\HeroRaces;
use App\Modules\HeroModule\Domain\HeroWeapons;
use App\Modules\HeroModule\HeroFactory;
use PHPUnit\Framework\TestCase;


class Request
{
    public $first_name;
}

class HeroFactoryTest extends TestCase
{
    /**
     * Test Hero factory.
     * Create a valid hero..
     * @return void
     */
    public function testFactory()
    {
        $validationResult = HeroFactory::makeHero([
            'first_name' => 'Bheizer',
            'last_name' => 'Bheizer',
            'race' => HeroRaces::Dwarf,
            'class' => HeroClass::Paladin,
            'weapon' => HeroWeapons::Dagger,
            'strength' => 1,
            'intelligence' => 1,
            'dexterity' => 1
        ], new Hero);

        $this->assertTrue($validationResult->isValid());
    }

    /**
     * Test Hero factory.
     * Create a not valid hero.
     * @return void
     */
    public function testInvalidHeroFactory()
    {
        $validationResult = HeroFactory::makeHero([
            'first_name' => '',
            'last_name' => '',
            'race' => HeroRaces::Dwarf,
            'class' => HeroClass::Paladin,
            'weapon' => HeroWeapons::Dagger,
            'strength' => 1,
            'intelligence' => 1,
            'dexterity' => 1
        ], new Hero);

        foreach ($validationResult->errors as $valor) {
            echo '======================================     =============\n';
            foreach ($valor as $error)
                echo $error.'\n';
        }

        $this->assertFalse($validationResult->isValid());
    }
}
