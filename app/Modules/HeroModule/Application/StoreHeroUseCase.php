<?php


namespace App\Modules\HeroModule\Application;


use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\HeroCreationResult;
use App\Modules\HeroModule\HeroFactory;

abstract class StoreHeroUseCase
{
    /**
     * Instances of HeroCreationResult.
     *
     * @var HeroCreationResult
     */
    protected $creationResult;

    /**
     *
     * @var array represent JSon for store hero request;
     */
    protected $storeHeroRequest;

    /**
     * Determinate if hero is for creation or edition.
     *
     * @return  Hero
     */
    abstract protected function determinateHero();

    /**
     * Store hero.
     * This works for hero creation or edition;
     * @param array $storeHeroRequest
     * @return HeroCreationResult
     */
    public function storeHero($storeHeroRequest)
    {
        $this->storeHeroRequest = $storeHeroRequest;
        $hero = $this->determinateHero();
        $this->creationResult = HeroFactory::makeHero($storeHeroRequest, $hero);

        if ($this->creationResult->isValid())
            $this->creationResult->hero->save();
        return $this->creationResult;
    }

}
