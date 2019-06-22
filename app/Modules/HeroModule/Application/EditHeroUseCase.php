<?php

namespace App\Modules\HeroModule\Application;

use App\Modules\HeroModule\Domain\Hero;

class EditHeroUseCase extends StoreHeroUseCase
{
    /**
     * Determinate if hero is for creation or edition.
     * Case for edition.
     * @return  Hero
     */
    protected function determinateHero()
    {
        $hero = Hero::find($this->storeHeroRequest['id']);
        return $hero;
    }
}
