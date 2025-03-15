<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use jcobhams\NewsApi\NewsApi;

class NewsController extends Controller
{
    public function getNytTopNewsUpdates(Request $request)
    {
        $category = $request->query('category', 'nyregion');
        $apiKey = env('NYT_API_KEY');
        $url = "https://api.nytimes.com/svc/topstories/v2/{$category}.json?api-key={$apiKey}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
        ]);

        $result = curl_exec($ch);

        if ($result === false) {
            echo curl_error($ch);
        } else {
            return response()->json(json_decode($result));
        }

        curl_close($ch);
    }

    public function getNewsApiUpdates(Request $request)
    {
        $apiKey = env('NEWS_API_KEY');
        $newsapi = new NewsApi($apiKey);
        $category = 'technology';
        $country  = 'us';
        $language  = 'en';

        $result = $newsapi->getTopHeadlines($category, $language, $country);
        dd($result);
    }
}
