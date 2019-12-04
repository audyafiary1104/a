<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use  App\Library\ApiModel;
class CountryController extends Controller
{
    public function __construct()
    {
        $this->apiModel = new  ApiModel();
    }

    public function index(){
        $country = DB::table('country')->select('languages','name')->get();
        return view('welcome',compact('country'));
    }
    public function translate(Request $request){
        $skuList = explode("\r\n", $request->textarea);
        $from = json_decode($request->from)[0];
        $to = json_decode($request->to)[0];
        $array = [];
        foreach ($skuList as $value){
            $result = $this->apiModel->translate($from,$to,$value);
            if (!json_decode($result)){
                $isi = null;
            }else{
                $isi = json_decode($result)->outputs[0]->output;
            }
            $value = [
              $value => $isi
            ];
            array_push($array,$value);
        }
        file_put_contents('local.txt',print_r($array, TRUE));
    }
}
