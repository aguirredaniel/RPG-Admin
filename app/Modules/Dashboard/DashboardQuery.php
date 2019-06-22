<?php


namespace App\Modules\Dashboard;


use Illuminate\Support\Facades\DB;

class DashboardQuery
{

    /**
     * Query function to retrieve data for dashboard.
     * Hero data is only retrieve data for the moment.
     * @param
     * @return array query result for dashboard.
     * @throws
     */
    public function execute()
    {
        $availableHeroes = DB::table('heroes')
            ->select(DB::raw('count(*) as count'))
            ->whereNull('deleted_at')
            ->get();

        $heroRacePopularity = DB::table('heroes')
            ->select(DB::raw('count(*) as count, race as race'))
            ->whereNull('deleted_at')
            ->groupBy('race')
            ->orderByDesc('count')
            ->get();


        $heroClassPopularity = DB::table('heroes')
            ->select(DB::raw('count(*) as count, class as class'))
            ->whereNull('deleted_at')
            ->groupBy('class')
            ->orderByDesc('count')
            ->get();

        $heroWeaponPopularity = DB::table('heroes')
            ->select(DB::raw('count(*) as count, weapon as weapon'))
            ->whereNull('deleted_at')
            ->groupBy('weapon')
            ->orderByDesc('count')
            ->get();

        return [
            'availableHeroes' => $availableHeroes,
            'heroRacePopularity' => $heroRacePopularity,
            'heroClassPopularity' => $heroClassPopularity,
            'heroWeaponPopularity' => $heroWeaponPopularity
        ];
    }
}
