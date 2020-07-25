<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Meal;
use App\Models\Week;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class WeekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $week = Week::with('days.meal')->first();
        return view('week.index', compact('week'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|RedirectResponse|View
     */
    public function create()
    {
        if (count(Week::all()) > 0) {
            return redirect(route('week.index'));
        }
        return view('week.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $days       = $request->days;
        $effort     = $request->effort;

        $week = new Week();

        $week->start_date = now()->toDate()->format('Y-m-d');
        $week->end_date = now()->addDays($days)->format('Y-m-d');
        $week->save();

        $meals = Meal::distinct()->where(['effort' => $effort])->inRandomOrder()->limit($days)->get();

        $meals->each(function($meal, $index) use($week) {
            $day = Day::create([
                'week_id' => $week->id,
                'chef' => Meal::CHEFS[array_rand(Meal::CHEFS)],
                'date' => now()->addDays($index)->toDate()->format('Y-m-d')
            ]);
            $day->meal()->save($meal);
            $week->days()->save($day);
        });

        return redirect(route('week.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Week $week
     * @return Response
     */
    public function show(Week $week)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Week $week
     * @return Response
     */
    public function edit(Week $week)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Week $week
     * @return Response
     */
    public function update(Request $request, Week $week)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Week $week
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Week $week)
    {
        try {
            $week->delete();
        } catch (\Exception $e) {
            dd('failed to delete: ' . $e->__toString());
        }
        return redirect(route('week.index'));
    }
}
