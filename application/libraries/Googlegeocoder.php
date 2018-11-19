<?php defined('BASEPATH') OR exit('No direct script access allowed');

class GoogleGeocoder
{
    public function __construct()
    {
        $this->baseURL = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyBg6Ws3Vj6snR1AWd4vYxG8mU3sVcrXYP4&sensor=false";
      
    }

    public function geocode($address)
    {
       $url = $this->baseURL . "&address=" . urlencode($address);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $contents = curl_exec($ch);
        curl_close($ch);

        if ($contents) {
            $resp = json_decode($contents);
            if($resp->status = 'OK'){
                return $resp->results[0]->geometry->location;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function reverseGeocode($location)
    {
        $url = $this->baseURL . "&latlng=" . $location;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $contents = curl_exec($ch);
        curl_close($ch);

        if ($contents) {
            $resp = json_decode($contents);
            if($resp->status = 'OK'){
                return $resp->results[0]->formatted_address;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}

?>