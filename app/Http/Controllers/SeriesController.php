<?php

namespace App\Http\Controllers;
use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::all();

        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view(view:'series.create');
    }


    public function store(Request $request)
    {
        $serieName = $request->input(key: 'name');
        $serie = new Serie();
        $serie->name = $serieName;
        $serie->save();


        return redirect(to: '/series');
    }
}
