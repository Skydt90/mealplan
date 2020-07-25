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
use Illuminate\Support\Carbon;
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
        $now  = now()->toDate()->format('Y-m-d');
        $week = Week::with('days.meal')->where([['start_date', '<=', $now], ['end_date', '>=', $now]])->first();

        return view('week.index', compact('week'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
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
        $duplicates = $request->duplicates;

        $week = Week::create([
            'start_date' => now()->toDate()->format('Y-m-d'),
            'end_date'   => now()->addDays($days)->format('Y-m-d')
        ]);

        if ($duplicates) {
            $meals = Meal::where(['effort' => $effort])->inRandomOrder()->limit($days)->get();
        } else {
            $meals = Meal::distinct()->where(['effort' => $effort])->inRandomOrder()->limit($days)->get();
        }

        $meals->each(function($meal, $index) use($week) {
            $day = Day::create([
                'week_id' => $week->id,
                'chef' => Meal::CHEFS[array_rand(Meal::CHEFS)],
                'date' => now()->addDays($index)->toDate()->format('Y-m-d')
            ]);
            $day->meal()->save($meal);
            $week->days()->save($day);
        });
        $week = Week::with('days.meal')->where('id', $week->id)->first();

        return redirect(route('week.index', ['week' => $week]));
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
     * @return Response
     */
    public function destroy(Week $week)
    {
        //
    }
}
