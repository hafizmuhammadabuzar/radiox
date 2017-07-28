<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends CI_Controller
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
    
    private function checkLogin(){
        
        if($this->session->userdata('admin_login') == FALSE){
            $this->session->set_userdata('msg', 'You are not Logged In, Please login first');
            redirect('admin');
        }
    }
    
    public function index(){
        
        $this->load->view('admin/header');
        $this->load->view('admin/login');
        $this->load->view('admin/footer');
    }
    
    public function login(){

        if($_POST['username'] == 'admin' && $_POST['password'] == 'admin'){
            $this->session->set_userdata('admin_login', 'radio-admin');
            redirect('admin/dashboard');
        }
        else{
            $this->session->set_userdata('msg', 'Incorrect username or Password');
            redirect('admin');
        }
    }
    
    public function logout(){

        $this->session->unset_userdata('admin_login');
        session_destroy();
        redirect('admin');
    }
    
    public function dashboard(){        
        $this->checkLogin();
        
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer');
    }
    
    function addSchedule(){
        $this->checkLogin();

        $this->load->view('admin/header');
        $this->load->view('admin/add_schedule');
        $this->load->view('admin/footer');
    }

    function viewSchedules()
    {
        $this->checkLogin();

        $result['sch'] = $this->Home_model->getRecords('schedule', '', '', 'sort');

        $this->load->view('admin/header');
        $this->load->view('admin/view_schedules', $result);
        $this->load->view('admin/footer');
    }

    public function saveSchedule()
    {
        $this->form_validation->set_rules('day', 'Day', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/addSchedule');
        }
        else {
            $day_sort = ['Sunday' => 1, 'Monday' => 2, 'Tuesday' => 3, 'Wednesday' => 4, 'Thursday' => 5, 'Friday' => 6, 'Saturday' => 7];
//            'time' => date('h:i A', strtotime($this->input->post('time')) - 60 * 60 * 4),
            $data = array(
                'day' => $this->input->post('day'),
                'time' => date('H:i:s', strtotime($this->input->post('time'))),
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'sort' => $day_sort[$this->input->post('day')],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $res = $this->Home_model->saveRecord('schedule', $data);

            if ($res > 0) {
                $this->session->set_userdata('msg', "Successfully saved!");
                redirect('admin/viewSchedules');
            }
            else {
                $this->session->set_userdata('msg', "Could not be saved!");
                redirect('admin/addSchedule');
            }
        }
    }

    function editSchedule($id)
    {
        $this->checkLogin();
        $id = pack("H*", $id);
        
        $result['sch'] = $this->Home_model->checkRecord('schedule', array('id' => $id));
        $this->load->view('admin/header');
        $this->load->view('admin/add_schedule', $result);
        $this->load->view('admin/footer');
    }

    public function updateSchedule()
    {
        $this->form_validation->set_rules('day', 'Day', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {

            redirect('admin/editSchedule/' . $_POST['sch_id']);
        }
        else {
            $id = pack("H*", $_POST['sch_id']);

            $day_sort = ['Sunday' => 1, 'Monday' => 2, 'Tuesday' => 3, 'Wednesday' => 4, 'Thursday' => 5, 'Friday' => 6, 'Saturday' => 7];
            $data = array(
                'day' => $this->input->post('day'),
                'time' => date('H:i:s', strtotime($this->input->post('time'))),
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'sort' => $day_sort[$this->input->post('day')],
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $res = $this->Home_model->updateRecord('schedule', ['id' => $id], $data);

            if ($res > 0) {
                $this->session->set_userdata('msg', "Successfully saved!");
                redirect('admin/viewSchedules');
            }
            else {
                $this->session->set_userdata('msg', "Could not be saved!");
                redirect('admin/editSchedule/' . $_POST['sch_id']);
            }
        }
    }

    function deleteSchedule($id)
    {
        $this->checkLogin();
        $id = pack("H*", $id);

        $res = $this->Home_model->deleteRecord('schedule', array('id' => $id));
        if ($res > 0) {
            $this->session->set_userdata('msg', "Successfully Deleted!");
        }
        else {
            $this->session->set_userdata('msg', "Could not be Deleted!");
        }
        redirect('admin/viewSchedules');
    }
    
    
    function addTrack(){
        $this->checkLogin();

        $this->load->view('admin/header');
        $this->load->view('admin/add_track');
        $this->load->view('admin/footer');
    }

    function viewTracks()
    {
        $this->checkLogin();

        $result['tracks'] = $this->Home_model->getRecords('tracks', '', '', 'sort');

        $this->load->view('admin/header');
        $this->load->view('admin/view_tracks', $result);
        $this->load->view('admin/footer');
    }

    public function saveTrack()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('movie', 'Movie', 'required');
        $this->form_validation->set_rules('song', 'Song', 'required');
        $this->form_validation->set_rules('last_week_position', 'Last Week Position', 'required');
        $this->form_validation->set_rules('weeks_on_chart', 'Weeks on Chart', 'required');
        $this->form_validation->set_rules('peak_position', 'Peak Position', 'required');
        $this->form_validation->set_rules('sort', 'Sort', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/addTrack');
        }
        else {
            if($_FILES['thumbnail']['name'] != ''){
                $ext = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
                $thumbnail = uniqid() . '.' . $ext;
                $path = 'assets/uploads/' . $thumbnail;
                move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path);
            }else{
                $thumbnail = '';
            }
            
            $data = array(
                'title' => $this->input->post('title'),
                'movie' => $this->input->post('movie'),
                'song' => $this->input->post('song'),
                'url' => $this->input->post('url'),
                'last_week_position' => $this->input->post('last_week_position'),
                'weeks_on_chart' => $this->input->post('weeks_on_chart'),
                'peak_position' => $this->input->post('peak_position'),
                'image' => $thumbnail,
                'sort' => $this->input->post('sort'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $res = $this->Home_model->saveRecord('tracks', $data);

            if ($res > 0) {
                $this->session->set_userdata('msg', "Successfully saved!");
                redirect('admin/viewTracks');
            }
            else {
                $this->session->set_userdata('msg', "Could not be saved!");
                redirect('admin/addTrack');
            }
        }
    }

    function editTrack($id)
    {
        $this->checkLogin();
        $id = pack("H*", $id);
        
        $result['track'] = $this->Home_model->checkRecord('tracks', array('id' => $id));
        $this->load->view('admin/header');
        $this->load->view('admin/add_track', $result);
        $this->load->view('admin/footer');
    }

    public function updateTrack()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('movie', 'Movie', 'required');
        $this->form_validation->set_rules('song', 'Song', 'required');
        $this->form_validation->set_rules('last_week_position', 'Last Week Position', 'required');
        $this->form_validation->set_rules('weeks_on_chart', 'Weeks on Chart', 'required');
        $this->form_validation->set_rules('peak_position', 'Peak Position', 'required');
        $this->form_validation->set_rules('sort', 'Sort', 'required');

        if ($this->form_validation->run() == FALSE) {

            redirect('admin/editTrack/' . $_POST['track_id']);
        }
        else {
            $id = pack("H*", $_POST['track_id']);
            
            if($_FILES['thumbnail']['name'] != ''){
                $ext = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
                $thumbnail = uniqid() . '.' . $ext;
                $path = 'assets/uploads/' . $thumbnail;
                move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path);
            }else{
                $thumbnail = $this->input->post('old_thumbnail');
            }

            $data = array(
                'title' => $this->input->post('title'),
                'movie' => $this->input->post('movie'),
                'song' => $this->input->post('song'),
                'url' => $this->input->post('url'),
                'last_week_position' => $this->input->post('last_week_position'),
                'weeks_on_chart' => $this->input->post('weeks_on_chart'),
                'peak_position' => $this->input->post('peak_position'),
                'image' => $thumbnail,
                'sort' => $this->input->post('sort'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $res = $this->Home_model->updateRecord('tracks', ['id' => $id], $data);

            if ($res > 0) {
                $this->session->set_userdata('msg', "Successfully saved!");
                redirect('admin/viewTracks');
            }
            else {
                $this->session->set_userdata('msg', "Could not be saved!");
                redirect('admin/editTrack/' . $_POST['track_id']);
            }
        }
    }

    function deleteTrack($id)
    {
        $this->checkLogin();
        $id = pack("H*", $id);
        
        $image = $this->Home_model->checkRecord('tracks', array('id' => $id));
        $res = $this->Home_model->deleteRecord('tracks', array('id' => $id));
        if ($res > 0) {
            if(!empty($image->image)){
                unlink('assets/uploads/'.$image->image);
            }
            $this->session->set_userdata('msg', "Successfully Deleted!");
        }
        else {
            $this->session->set_userdata('msg', "Could not be Deleted!");
        }
        redirect('admin/viewTracks');
    }
    
    function pushNotification(){
        $this->checkLogin();

        $this->load->view('admin/header');
        $this->load->view('admin/push_notification');
        $this->load->view('admin/footer');
    }
    
    public function sendNotification()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('msg', 'Message', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/header');
            $this->load->view('admin/push_notification');
            $this->load->view('admin/footer');
        }
        else {
            $title = $_POST['title'];
            $msg = $_POST['msg'];

            $result_android = $this->androidNotification($title, $msg);
//            $result_ios = $this->iosNotification($title, $msg);

            if (isset($result_ios) || isset($result_android)) {
                $this->session->set_userdata('error', 'Successfully Sent !');
                redirect('admin/pushNotification');
            }
        }
    }

    public function iosNotification($noti_title, $msg)
    {
        $title = array(
            "en" => $noti_title,
        );
        $content = array(
            "en" => $msg,
        );

        $fields = array(
            'app_id' => "37d7cc4d-fc7d-408f-8ba2-60ea0055d4a5",
            'included_segments' => array("All"),
            'contents' => $content,
            'heading' => $title,
            'data' => ['title' => $noti_title, 'body' => $msg],
            'ios_badgeType' => 'SetTo',
            'ios_badgeCount' => 1,
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Basic ZDU1NjQ0NjgtMzU2My00NzAzLWI2NGQtMGU3MDczMmE5ZmI4'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function androidNotification($title, $body)
    {
        $tokens = $this->Home_model->getRecords('tokens', ['token'], ['null' => 'device_id IS NOT NULL']);
        
        foreach ($tokens as $tk) {
            $ids[] = $tk['token'];
        }

        $chunks = array_chunk($ids, 1000);

        foreach ($chunks as $chk) {

            define('API_ACCESS_KEY', 'AIzaSyBskrMvvNAhWZlZh7nH4LyyPp_VK03aCaI');
            $registrationIds = $ids;

            $msg['notification'] = array(
                'title' => $title,
                'message' => $body
            );

            $fields = array(
                'registration_ids' => $registrationIds,
                'data' => $msg
            );

            $headers = array(
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);

            return $result;
        }
    }
}
