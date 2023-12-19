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

}
