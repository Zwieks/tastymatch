<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // public function showDetails(Request $request){
    //     $data = $request->all(); // This will get all the request data.

    //    return response()->json($data); // This will dump and die
    // }

    public function showDetails(Request $request){
        $data = $request->all(); // This will get all the request data.
        $key = '2c4cce55a0283c1f6124a5e731cb972d1f3e3281ed9e7b2c7fb2f21f0119f6c0';
        $fields = '&fields[]=postcode&fields[]=huisnummer&fields[]=plaats&fields[]=postcode&fields[]=plaats&fields[]=straat&fields[]=type&fields[]=actief';
        $jsonurl = "https://overheid.io/api/kvk?query=".$data['value'].$fields."&ovio-api-key=".$key;

        $json_output = $this->get_json($jsonurl);

        //Check if business already exist
        $get_token = $this->CheckBusinessName($data['value']);

        if($get_token == false){
            return response()->json($json_output); // This will dump and die
        }else{
            $json_output = false;
            return response()->json($json_output);
        }
    }

    public function get_json($jsonurl) {
        try{
            $response = $this->fetchUrl($jsonurl);
        } catch(Exception $ex){
            return true;
        }
       
        return $response;
    }
    
    public function CheckBusinessName($tradename){

        $check = DB::table('users')->where('tradename', $tradename)->exists();
        return $check;           
    }

    private function fetchUrl($url) {

        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $response = curl_exec($curl);

        if (!$response) {
            return curl_error($curl);
            curl_close($curl);
        }
        curl_close($curl);
        return $response;
    }
}
