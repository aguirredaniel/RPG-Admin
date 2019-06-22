<?php


namespace App\Modules\Dashboard\Delivery;


use App\Modules\HeroModule\Delivery\HeroPresenter;

class DashboardPresenter
{
    /**
     * Make presentable data for dashboard.
     * Present enums (race/class/weapon) for humans.
     * @param array $queryResult for data dashboard.
     * @return array query result presentable for dashboard.
     * @throws
     */
    public static function presentDashboardQueryResult($queryResult)
    {
        foreach ($queryResult['heroRacePopularity'] as $racePopularity) {
            $racePopularity->race = HeroPresenter::presentHeroRace($racePopularity->race)['name'];
        }
        foreach ($queryResult['heroClassPopularity'] as $heroClassPopularity) {
            $heroClassPopularity->class = HeroPresenter::presentHeroClass($heroClassPopularity->class)['name'];
        }
        foreach ($queryResult['heroWeaponPopularity'] as $heroWeaponPopularity) {
            $heroWeaponPopularity->weapon = HeroPresenter::presentHeroWeapon($heroWeaponPopularity->weapon)['name'];
        }


        return $queryResult;
    }
}
