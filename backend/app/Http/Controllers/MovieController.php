<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function uploadJson(Request $request)
    {
        $request->validate([
            'json_file' => 'required|file|mimes:json|max:2048', // Max size 2MB
        ]);

        $file = $request->file('json_file');
        $jsonData = file_get_contents($file->getRealPath());
        $data = json_decode($jsonData, true);

        // Validate that the JSON is decoded properly
        if (!$data) {
            return response()->json(['message' => 'Invalid JSON data'], 400);
        }

        foreach ($data as $movieData) {
            Movie::create([
                'title' => $movieData['Title'],
                'year' => $movieData['Year'],
                'rated' => $movieData['Rated'],
                'title' => $movieData['Released'],
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
                'image' => $movieData['Images'][0],
            ]);
        }

        return response()->json(['message' => 'Movies inserted successfully'], 200);
    }
}
