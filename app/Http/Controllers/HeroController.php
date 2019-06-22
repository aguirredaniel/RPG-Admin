<?php


namespace App\Http\Controllers;

use App\Modules\HeroModule\Application\CreateHeroUseCase;
use App\Modules\HeroModule\Application\EditHeroUseCase;
use App\Modules\HeroModule\Delivery\HeroPresenter;
use App\Modules\HeroModule\Domain\Hero;
use App\Modules\HeroModule\HeroFactory;
use Illuminate\Http\Request;


class HeroController extends Controller
{
    /**
     * Show the create page for a hero.
     *
     * @param
     * @return View
     */
    public function create()
    {
        return view('hero.create', [
            'id' => 0
        ]);
    }

    /**
     * Show the edit page for a hero.
     *
     * @param
     * @return View
     */
    public function edit($id)
    {
        return view('hero.create', [
            'id' => $id
        ]);
    }

    /**
     * Store a new hero.
     *
     * @param Request $request
     * @return json response of stored a hero.
     */
    public function store(Request $request)
    {

        if (!isset($request->all()['id']) || $request->all()['id'] == 0) {
            $useCase = new CreateHeroUseCase;
            $response = $useCase->storeHero($request->all());
        } else {
            $useCase = new EditHeroUseCase;
            $response = $useCase->storeHero($request->all());
        }

        return response()->json([
            'hero_id' => $response->hero->id,
            'errors' => $response->errors
        ]);
    }

    /**
     * Delete a hero.
     *
     * @param int $id hero.
     * @return redirect to index page.
     */
    public function delete($id)
    {
        Hero::findOrFail($id)->delete();

        return redirect('/hero');
    }

    /**
     * Index for heroes.
     *
     * @param
     * @return json of presentable heroes.
     */

    public function index()
    {
        $heroes = Hero::orderByDesc('created_at', 'asc')->get();
        $heroesPresentables = [];

        foreach ($heroes as $hero)
            array_push($heroesPresentables, HeroPresenter::presentHero($hero));


        return view('hero.index', [
            'heroes' => $heroesPresentables
        ]);
    }

    /**
     * Data for store hero forms.
     *
     * @param
     * @return json data for store hero forms, like first names, last names, races.
     */
    public function formData()
    {
        return response()->json([
            'firstNames' => HeroPresenter::presentFirstNames(),
            'lastNames' => HeroPresenter::presentLastNames(),
            'races' => HeroPresenter::presentHeroRaces()
        ]);
    }

    /**
     * Available hero classes.
     *
     * @param
     * @return json available hero classes for a hero race.
     */
    public function availableClass($heroRace)
    {
        $heroRace = HeroFactory::makeHeroRace($heroRace);

        return response()->json(HeroPresenter::presentHeroRaceCreationRules($heroRace));
    }

    /**
     * Aavailable hero weapons.
     *
     * @param
     * @return json available hero weapons for a hero class.
     */
    public function availableWeapons($heroClass)
    {
        $heroClass = HeroFactory::makeHeroClass($heroClass);

        return response()->json(HeroPresenter::presentHeroClassCreationRules($heroClass));
    }


    public function data($id)
    {
        $hero = Hero::find($id);
        return response()->json(HeroPresenter::presentHeroEditable($hero));
    }
}
