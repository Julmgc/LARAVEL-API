<?php

namespace App\Http\Controllers;
use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::all();
        $messageSuccess = $request->session()->get(key:'message.success');
        return view('series.index')->with('series', $series)->with('messageSuccess', $messageSuccess);
    }

    public function create()
    {
        return view(view:'series.create');
    }

    public function store(Request $request)
    {
        Serie::create($request->all());
        $request->session()->flash('message.success','Series was added.');
        return to_route('series.index');
    }

    public function destroy(Request $request) 
    {
        Serie::destroy($request->series);
        $request->session()->flash('message.success', 'Series was removed');

        return to_route(route: 'series.index');
    }
}
