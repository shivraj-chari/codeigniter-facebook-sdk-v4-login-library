<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller {

	 function __construct() {
        parent::__construct();
        $this->load->model('general_model');
        $this->load->library('facebook');
    }

	public function index(){

		$data['users']=$this->general_model->GetAllInfo('user','id');
		$data['facebook_login_url']=$this->facebook->get_login_url();
		$this->load->view('home_view',$data);
	}

	public function do_login(){
		
	}

	public function handle_facebook_response(){
		$fb_data=$this->facebook->validate();
		//var_dump( $fb_data);
		//array to store data in database
		if(isset($fb_data)){
			$user=$this->general_model->GetAllInfo('user','id',array('email'=>$fb_data['email']));
			if(count($user)>0){
				$session_data=array(
					'name'=>$fb_data['name'],
					'email'=>$fb_data['email'],
					'profile_pic'=>"http://graph.facebook.com/".$fb_data['id']."/picture?width=800",
					'link'=>$fb_data['link'],
					'sess_logged_in'=>1
					);
				$this->session->set_userdata($session_data);
				
			}else{
				$data=array(
					'name'=>$fb_data['name'],
					'email'=>$fb_data['email'],
					'source'=>'facebook',
					'profile_pic'=>"http://graph.facebook.com/".$fb_data['id']."/picture?width=800",
					'link'=>$fb_data['link']
				);
				$this->general_model->SaveForm('user',$data);
				$session_data=array(
					'name'=>$fb_data['name'],
					'email'=>$fb_data['email'],
					'profile_pic'=>"http://graph.facebook.com/".$fb_data['id']."/picture?width=800",
					'link'=>$fb_data['link'],
					'sess_logged_in'=>1
					);
				
				$this->session->set_userdata($session_data);
			}
			redirect(base_url());

		}else{
			$this->session->set_flashdata('message','Error while authenticating using facebook');
			redirect(base_url());
		}
		
			
			
			
		
		
		
		

	}

	public function logout(){
		session_destroy();
		$session_data=array(
				'sess_logged_in'=>0
				);
		$this->session->set_userdata($session_data);
		redirect(base_url());
	}
}