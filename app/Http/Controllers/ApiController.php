<?php

namespace App\Http\Controllers;

use App\Fb;
use App\FbKeyword;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    function search(Request $request, $q = null)
    {
        $validator = Validator::make(["keyword" => $q], [
            'keyword' => 'unique:fb_interests_keys',
        ]);

        if ($validator->fails()) {
            $keyword_id = FbKeyword::where(['keyword' => $q])->first()->id;
            $query = Fb::where(['keyword' => $keyword_id])->get();

            $result = $query->toArray();
        } else {
            $result = $this->targetingSearch($q);

            $fbKeyword = new FbKeyword([
                'keyword' => $q,
            ]);
            $fbKeyword->save();

            foreach ($result as $item) {
                $interest = new Fb([
                    'keyword' => $fbKeyword->id,

                    'fb_id' => $item['id'],
                    'name' => $item['name'],
                    'audience_size' => $item['audience_size'],
                    'path' => json_encode($item['path']),
                    'description' => $item['description'],
                    'topic' => $item['topic'] ?? null,

                ]);
                $interest->save();
            }
        }

        return response()->json(["data"=>$result], 200, [], JSON_PRETTY_PRINT);

    }

    private function targetingSearch($q = "baseball")
    {

        $app_key = env("FB_APP");
        $app_secret = env("FB_SECRET_KEY");
        $access_token = env("FB_ACCESS_TOKEN");

        /*
        //official sdk did not working :(
        $api = Api::init($app_key, $app_secret, $access_token);
        $result = TargetingSearch::search(
        "adinterest",
        "",
        'q');
        */

        $client = new \GuzzleHttp\Client();
        try {
            $res = $client->request('GET', sprintf("https://graph.facebook.com/v2.11/search?type=%s&q=%s&access_token=%s",
                "adinterest",
                $q,
                $access_token
            ));
            $result = json_decode((string)$res->getBody(), true)['data'];
        } catch (GuzzleException $e) {
            $result = false;
        }

        return $result;
    }
}
