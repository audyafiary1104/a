<?php
namespace App\Library;

class ApiModel
{
    public function get_country()
    {
     $curl = curl_init();

     curl_setopt_array($curl, array(
         CURLOPT_URL => "https://restcountries-v1.p.rapidapi.com/all",
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_FOLLOWLOCATION => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_HTTPHEADER => array(
             "x-rapidapi-host: restcountries-v1.p.rapidapi.com",
             "x-rapidapi-key: 372730fcb7mshf62cd1aa1ae1262p1788fbjsn678ed6414afd"
         ),
     ));

     $response = json_decode(curl_exec($curl));
     $err = curl_error($curl);

     curl_close($curl);
     foreach ($response as $key => $value) {


         DB::table('country')->insert([
             'name' => $value->name,
             'alphacode' => $value->alpha3Code,
             'callingCodes' => json_encode($value->callingCodes),
             'currencies' => json_encode( $value->currencies),
             'subregion' =>  $value->subregion,
             'regions'   => $value->region,
             'timezones' =>json_encode($value->timezones),
             'languages' => json_encode($value->languages,JSON_UNESCAPED_UNICODE),
             'translations' => json_encode($value->translations,JSON_UNESCAPED_UNICODE),
         ]);
     }
     return response()->json(['status','success add Data']);
    }

    public function Currency($from = '',$to = '',$from_amount ='')
   {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://currencyconverter.p.rapidapi.com/?from_amount=$from_amount&from=$from&to=$to",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: currencyconverter.p.rapidapi.com",
                "x-rapidapi-key: 372730fcb7mshf62cd1aa1ae1262p1788fbjsn678ed6414afd"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return $response;
   }

   public function translate($source = 'en',$target = '',$input = '')
   {
        $curl = curl_init();
//        dd($input);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://systran-systran-platform-for-language-processing-v1.p.rapidapi.com/translation/text/translate?source=$source&target=$target&input=$input",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: systran-systran-platform-for-language-processing-v1.p.rapidapi.com",
                "x-rapidapi-key: 372730fcb7mshf62cd1aa1ae1262p1788fbjsn678ed6414afd"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }

   }
}
