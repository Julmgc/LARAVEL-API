<x-layout title="New Series " >
    <form action="{{ route('series.store') }}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-8">
                <label for="name" class="form-label">name:</label>
                <input type="text" autofocus id="name" name="name" class="form-control" 
                value="{{ old('name') }}">
           </div>
           <div class="col-2">
            <label for="seasonsQty" class="form-label">Seasons:</label>
            <input type="text" id="seasonsQty" name="seasonsQty" class="form-control" 
            value="{{ old("seasonsQty") }}">
            </div>
            <div class="col-2">
                <label for="episodes" class="form-label">Episodes per season:</label>
                <input type="text" id="episodes" name="episodes" class="form-control" 
                value="{{ old('episodes') }}">
            </div>
        </div>
   
        <button type="submit" class="btn btn-primary">Add</button>
   </form>
</x-layout>

