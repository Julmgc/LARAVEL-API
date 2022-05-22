<x-layout title="Edit Series '{!! $serie->name !!}'">
    <x-series.form :action="route('series.update', $series->id)" :name="$series->name" :update="true"></x-series.form>
</x-layout>