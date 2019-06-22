<?php


namespace Tests\Unit\Modules\HeroModule\Application;


use App\Modules\HeroModule\Application\CreateHeroUseCase;
use App\Modules\HeroModule\Application\EditHeroUseCase;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\Domain\HeroClass;
use App\Modules\HeroModule\Domain\HeroRaces;
use App\Modules\HeroModule\Domain\HeroWeapons;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateOrUpdateHeroUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test for hero creation use case.
     * All new Heroes start at Level 1.
     * @param
     * @return void.
     * @throws
     */
    public function testCreationHero()
    {
        $request = [
            'id' => 0,
            'level'=> 1000,
            'first_name' => 'Bheizer',
            'last_name' => 'Bheizer',
            'race' => HeroRaces::Dwarf,
            'class' => HeroClass::Paladin,
            'weapon' => HeroWeapons::Dagger,
            'strength' => 1,
            'intelligence' => 1,
            'dexterity' => 1
        ];


        $useCase = new CreateHeroUseCase;
        $useCase->storeHero($request);
        $heroCreated = Hero::where('first_name', 'Bheizer')->first();

        $this->assertNotNull($heroCreated);
        $this->assertTrue($heroCreated->level == 1);
    }

    public function testEditionHero(){
        $creationRequest = [
            'id' => 0,
            'level'=> 1000,
            'first_name' => 'Bheizer',
            'last_name' => 'Bheizer',
            'race' => HeroRaces::Dwarf,
            'class' => HeroClass::Paladin,
            'weapon' => HeroWeapons::Dagger,
            'strength' => 1,
            'intelligence' => 1,
            'dexterity' => 1
        ];


        $useCase = new CreateHeroUseCase;
        $useCase->storeHero($creationRequest);

        $editionRequest = [
            'id' => 1,
            'level'=> 1000,
            'first_name' => 'Bheizer',
            'last_name' => 'Bheizer',
            'race' => HeroRaces::Dwarf,
            'class' => HeroClass::Paladin,
            'weapon' => HeroWeapons::Dagger,
            'strength' => 2,
            'intelligence' => 2,
            'dexterity' => 2
        ];

        $useCase = new EditHeroUseCase;
        $useCase->storeHero($editionRequest);


        $heroEdited = Hero::where('first_name', 'Bheizer')->first();
        $this->assertNotNull($heroEdited);
        $this->assertTrue($heroEdited->strength == 2);
        $this->assertTrue($heroEdited->intelligence == 2);
        $this->assertTrue($heroEdited->dexterity == 2);
        $this->assertTrue($heroEdited->level == 1);
    }
}
