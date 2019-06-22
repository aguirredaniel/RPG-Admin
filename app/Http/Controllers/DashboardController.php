<?php


namespace App\Http\Controllers;


use App\Modules\Dashboard\DashboardQuery;
use App\Modules\Dashboard\Delivery\DashboardPresenter;
use App\Modules\HeroModule\Delivery\HeroPresenter;

class DashboardController
{

    public function index()
    {
        $query = new DashboardQuery;
        $queryResult = $query->execute();


        //return response()->json((object) DashboardPresenter::presentDashboardQueryResult($queryResult));

        return view('dashboard.index', [
            'data' => (object) DashboardPresenter::presentDashboardQueryResult($queryResult)
        ]);
    }
}
