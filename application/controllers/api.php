<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Home_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        define('error', 'Error');
        define('success', 'Success');
        
        date_default_timezone_set('Asia/Dubai');
    }

    function sendMessage()
    {  
        if(isset($_POST['submit'])){
            if(!empty($_POST['name']) && !empty($_POST['mobile']) || !empty($_POST['email']) || !empty($_POST['message'])){
                $this->load->library('phpmailer');
                $email = new PHPMailer();

                $content = '<b>Name: </b>';
                $content .= $this->input->post('name');
                $content .= '<br/><b>Mobile: </b>';
                $content .= $this->input->post('mobile');
                $content .= '<br/><b>Email: </b>';
                $content .= $this->input->post('email');
                $content .= '<br/><b>Description: </b>';
                $content .= $this->input->post('message');

                $email->From      = $this->input->post('email');
                $email->FromName  = $this->input->post('name');
                $email->Subject   = 'RadioX - Message Form';
                $email->MsgHTML($content);
                $email->AddAddress('pk@synergistics.ae');
                $email->Send();
                
                $this->session->set_userdata('msg', 'Email successfully sent, we will get back to you shortly.');
            }
            else{
                $this->session->set_userdata('error', 'All fields required');
            }
        }
            
        $this->load->view('message_us');
    }
    
    public function saveIosToken()
    {
        $token = $this->input->get_post('token');
        
        if(!empty($token)){            
            $fields = array(
                'app_id' => "37d7cc4d-fc7d-408f-8ba2-60ea0055d4a5",
                'identifier' => $token,
                'language' => "en",
                'timezone' => "-28800",
                'game_version' => "1.0",
                'device_os' => "",
                'device_type' => "0",
                'device_model' => "iPhone",
                'test_type' => 2,
            );

            $fields = json_encode($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/players");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($response);
            if ($response->success == true) {
                $date = date('Y-m-d H:i:s');

                $check = $this->Home_model->getRecords('tokens', ['token'], ['token' => $token]);

                if (count($check) == 0) {
                    $res = $this->Home_model->saveRecord('tokens', ['token' => $token, 'player_id' => $response->id, 'created_at' => $date]);

                    if ($res > 0) {
                        $result['status'] = 'Success';
                        $result['msg'] = 'Successfully saved';
                    }
                    else {
                        $result['status'] = 'Error';
                        $result['msg'] = 'Could not be saved';
                    }
                }
                else {
                    $result['status'] = 'Success';
                    $result['msg'] = 'Successfully saved';
                }
            }
            else {
                $result['status'] = 'Error';
                $result['msg'] = 'Could not be saved';
            }
        }
        else{
            $result['status'] = 'Error';
            $result['msg'] = 'Token Required';
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function saveAndroidToken()
    {
        $token = $this->input->get_post('token');
        $device_id = $this->input->get_post('device_id');
        $date = date('Y-m-d H:i:s');
        
        if(!empty($token) && !empty($device_id)){
            
            $check = $this->Home_model->getRecords('tokens', ['token'], ['token' => $token]);

            if (count($check) == 0) {
                $res = $this->Home_model->saveRecord('tokens', ['token' => $token, 'device_id' => $device_id, 'created_at' => $date]);

                if ($res > 0) {
                    $result['status'] = 'Success';
                    $result['msg'] = 'Successfully saved';
                }
                else {
                    $result['status'] = 'Error';
                    $result['msg'] = 'Could not be saved';
                }
            }
            else {
                $res = $this->Home_model->updateRecord('tokens', ['device_id' => $device_id], ['token' => $token]);

                if ($res > 0) {
                    $result['status'] = 'Success';
                    $result['msg'] = 'Successfully saved';
                }
                else {
                    $result['status'] = 'Error';
                    $result['msg'] = 'Could not be saved';
                }
            }
        }
        else{
            $result['status'] = 'Success';
            $result['msg'] = 'Token and Device Id required';
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    
}
