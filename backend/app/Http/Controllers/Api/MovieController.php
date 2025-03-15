<?php

namespace App\Http\Controllers\Api;
// use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\MovieResource;

class MovieController extends BaseController
{
    public function uploadJson(Request $request)
    {
        $request->validate([
            'json_file' => 'required|file|mimes:json|max:2048', // Max size 2MB
        ]);

        $file = $request->file('json_file');
        $jsonData = file_get_contents($file->getRealPath());
        $data = json_decode($jsonData, true);

        if (!$data) {
            return response()->json(['message' => 'Invalid JSON data'], 400);
        }

        foreach ($data as $movieData) {
            Movie::create([
                'title' => $movieData['Title'],
                'year' => $movieData['Year'],
                'rated' => $movieData['Rated'],
                'released' => $movieData['Released'],
                'runtime' => $movieData['Runtime'],
                'genre' => $movieData['Genre'],
                'director' => $movieData['Director'],
                'writer' => $movieData['Writer'],
                'actors' => $movieData['Actors'],
                'plot' => $movieData['Plot'],
                'language' => $movieData['Language'],
                'country' => $movieData['Country'],
                'awards' => $movieData['Awards'],
                'poster' => $movieData['Poster'],
                'type' => $movieData['Type'],
                'images' =>  isset($movieData['Images'][0]) ? $movieData['Images'][0] : null,
            ]);
        }
        
        return response()->json(['message' => 'Movies inserted successfully'], 200);
    }

    public function getAllMovies()
    {
        $movies = Movie::all();
        if ($movies->isEmpty()) {
            return $this->sendError('No records found');
        }

        return $this->sendResponse(MovieResource::collection($movies), 'Movies retrieved successfully.');
    }

    public function getMovie(int $id)
    { 
        $movie = Movie::find($id);

        if (!$movie) {
            return $this->sendError('No records found');
        }

        return $this->sendResponse(new MovieResource($movie), 'Movie retrieved successfully.');
    }
}
