<?php

namespace App\Modules\HeroModule\Application;

use App\Modules\HeroModule\Domain\Hero;

class CreateHeroUseCase extends StoreHeroUseCase
{
    /**
     * Determinate if hero is for creation or edition.
     * Case for creation.
     * @return  Hero
     */
    protected function determinateHero()
    {
        $hero = new Hero;
        $hero->level = 1;

        return $hero;
    }
}
