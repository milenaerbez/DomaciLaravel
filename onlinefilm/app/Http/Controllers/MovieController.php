<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $movie = Movie::all();
        return new MovieCollection($movie);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'year' => 'required|int',
            'genre_id' => 'required'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $movie = Movie::create([
            'title' => $request->title,
            'year' => $request->year,
            'description' => $request->description,
            'genre_id' => $request->genre_id,
            'user_id' => Auth::user()->id,
            'actor_id' => $request->actor_id

        ]);


        return response()->json('Dodali ste film.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function updateById(Request $request, int $id)
    {
        /* $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'description' => 'required|string|min:50',
        'year' => 'required',
        'genre_id' => 'required'
        ]);*/

        //   if ($validator->fails())
        //return response()->json($validator->errors());
        $movie = Movie::find($id);
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->year = $request->year;
        $movie->genre_id = $request->genre_id;
        $movie->actor_id = $request->actor_id;

        $movie->save();

        return response()->json(['Film je azuriran!', new MovieResource($movie)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return response()->json(['Obrisali ste film']);
    }

    public function thisyear(int $year)
    {
        $movie = Movie::get()->where('year', $year);

        return response()->json($movie->pluck('title'));
    }

    public function genremovies(int $id)
    {

        $movies = Movie::get()->where('genre_id', $id);
        if (is_null($movies)) {
            return response()->json("Ne postoji film ovog zanra");
        }
        return response()->json($movies->pluck('title'));
    }

}