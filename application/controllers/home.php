<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Home_model');
        $this->load->library('session');
    }
    
    public function index(){
        $this->load->view('index');
    }
    
    public function schedule(){
               
//        $this->session->unset_userdata('dst');
        
        $result['sch'] = $this->Home_model->getSchedules('Sunday');
        
        if(count($result['sch']) > 0){
            if($this->session->userdata('dst') == FALSE){
                $result['dst'] = $this->timezone();
            }
            else{
                $result['dst'] = $this->session->userdata('dst');
            }
        }
                
        $this->load->view('program_guide', $result);
    }
    
    
    public function getSchedule(){
                
        $result['sch'] = $this->Home_model->getSchedules($this->input->post('day'));
//        echo '<pre>'; print_r($result); die;
        
        if(count($result['sch']) > 0){
            if($this->session->userdata('dst') == FALSE){
                $result['dst'] = $this->timezone();
            }
            else{
                $result['dst'] = $this->session->userdata('dst');
            }
        }
        
        echo $this->load->view('partial/programs', $result);
    }
    
    public function tracks(){
               
        $result['tracks'] = $this->Home_model->getRecords('tracks', '', '', 'sort ASC');
        $this->load->view('tracks', $result);
    }
    
    private function timezone(){
                
//        $ipaddress = '207.244.83.197'; 
//        $ipaddress = '182.176.98.233'; 
//        $ipaddress = '123.50.64.0'; 
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=$ipaddress");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($json);
        
        $lat = $json->geoplugin_latitude;
        $lng = $json->geoplugin_longitude;
        
        $url_time = "http://api.geonames.org/timezoneJSON?lat=$lat&lng=$lng&username=hafizmabuzar";
        $xml_time = json_decode(file_get_contents($url_time));
        
        if($xml_time->dstOffset){
            $this->session->set_userdata('dst', $xml_time->dstOffset);
            return $xml_time->dstOffset;
        }
        else{
            return 4;
        }
        
//        date_default_timezone_set($xml_time->timezoneId);
//        $timestamp = time();
//        echo $t = date('r', $timestamp) . "\n";
    }
}
