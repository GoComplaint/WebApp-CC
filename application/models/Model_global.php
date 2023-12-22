<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_global extends CI_Model
{    
    public function get_url($kode) 
    {
        $arrKode = explode(" ", $kode);
        if(count($arrKode) > 1){
            foreach($arrKode as $url){
            if($arrKode[0] == $url){
                $kode_url = $url;
            }else{
                $kode_url = $kode_url."_".$url;
            }
            }
        }else{
            $kode_url = $kode;
        }

        return $kode_url;
    }

    public function postCURL($_url, $_data){
        $ch = curl_init($_url);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $_data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   

        $output=curl_exec($ch);

        curl_close($ch);

        return $output;
    }

}
