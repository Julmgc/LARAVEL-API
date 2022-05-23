<?php

namespace App\Http\Controllers;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Series::with(['seasons'])->get();
        $messageSuccess = $request->session()->get(key:'message.success');
        return view('series.index')->with('series', $series)->with('messageSuccess', $messageSuccess);
    }

    public function create()
    {
        return view(view:'series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $series = null;
        DB::transaction(function () use ($request, &$series) {
            $series = Series::create($request->all());
            $seasons = [];
        
            for ($i = 1; $i <= $request->seasonsQty; $i++) {
                $seasons[] = [
                    'series_id' => $series->id,
                    'number' => $i,
                ];
            }
    
            Season::insert($seasons);
    
            $episodes = [];
            foreach ($series->seasons as $season) {
                for ($j = 1; $j <= $request->episodes; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episodes);
        });


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

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route(route: 'series.index')->with('message.success', "Series {$series->name} was updated.");
    }
}
