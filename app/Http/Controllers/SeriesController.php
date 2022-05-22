<?php

namespace App\Http\Controllers;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Series::all();
        $messageSuccess = $request->session()->get(key:'message.success');
        return view('series.index')->with('series', $series)->with('messageSuccess', $messageSuccess);
    }

    public function create()
    {
        return view(view:'series.create');
    }

    public function store(Request $request)
    {
        $series = Series::create($request->all());
        return to_route('series.index')->with('message.success',"Series {$series->name} was added.");
    }

    public function destroy(Series $series, Request $request) 
    {
        $series->delete();
        return to_route(route: 'series.index')->with('message.success', "Series {$series->name} was removed");
    }

    public function edit(Series $series) 
    {
        return view(view: 'series.edit')->with('series', $series);
    }

    public function update(Series $series, Request $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route(route: 'series.index')->with('message.success', "Series {$series->name} was updated.");
    }
}
