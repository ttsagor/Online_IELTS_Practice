<?php
ini_set('max_execution_time', -1);
ini_set("memory_limit", "-1");
//error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Exampanel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('WebRegistrationModel');
		date_default_timezone_set('Asia/Dhaka');
		$this->load->library('session');
		session_start(); 
		
    	$st_id = $this->session->userdata('st_id');
        
        if(!isset($st_id))
        {
            $userid = $this->input->get('userid');
            $password = $this->input->get('password');
            if(isset($userid) && isset($password))
            {
                $test_id = $this->WebRegistrationModel->getSingleData('*',"user_login='$userid' AND user_pass='$password'",'wpao_users');
        	    if(isset($test_id->ID))
        	    {
                    $this->session->set_userdata(array(
                		'st_id'  => $test_id->ID
                	    ));
                }
                else
                {
                   redirect('https://www.ieltspracticezone.com', 'refresh');
                }
            }
            else
            {
               redirect('https://www.ieltspracticezone.com', 'refresh');
            }
        }
	}
	
	public function index()
	{
		$data = array();
		$data['title']='Dashboard';      
		$data['subtitle']='Control panel';
		$data['page_name']= "";
		$data['data']= "";
		$this->load->view('student-dashboard',$data);
	}	
	
	public function dashboard()
	{
        $data = array();
        $data['title']='Dashboard';      
        $data['subtitle']='Control panel';
        $data['page_name']= "student-package-list";
        $st_id = $this->session->userdata('st_id');
        $data['data']= $this->WebRegistrationModel->getdata('*',"post_type='lp_course' and post_status='publish' and ID in (SELECT item_id FROM wpao_learnpress_user_items WHERE user_id = $st_id)",'wpao_posts');
        
        //print_r($this->session->userdata());
        $this->load->view('student-dashboard',$data);
        
	}
	
	public function addmocktest()
	{
        $data = array();
        $data['title']='Mock Test';      
        $data['subtitle']='Create Mock Test';
        $data['page_name']= "add-mock-test";
        $data['data']= "";
        $this->load->view('Dashboard',$data);
        
	}
	
	public function addmocktestsubmit()
	{
	    $test_name = $this->input->post('test_name');
	    $category = $this->input->post('category');
	    $sl = 0;
        if(isset($test_name) && isset($category))
        {
            $mocktest['mt_name'] = $test_name;
            $mocktest['category'] = $category;
            $mocktest['create_date'] = date('Y-m-d H:i:s');;
            $mocktest['last_update_date'] = date('Y-m-d H:i:s');
			$key =" mt_name='$test_name', category='$category' ";
		    $sl = $this->WebRegistrationModel->insertUpdatedb('exam_mocktest',$mocktest,$key);
		   
		    if($sl!=0)
		    {
		        $url = base_url()."/index.php/AdminPanel/mocktestmodules?id=$sl";
		        redirect($url);
		    }
        }
		else
		{
			redirect('addmocktest');
		}
        
	}
	
	public function mocktestmodules()
	{
	    $id = $this->input->get('id');
	    $test_id = $this->WebRegistrationModel->getSingleData('*',"mt_id='$id'",'exam_mocktest');
	    if(isset($test_id))
	    {
            $data = array();
            $data['title']= $test_id->mt_name.' ('.$test_id->category.')';      
            $data['subtitle']='Add/Update Modules';
            $data['page_name']= "all-exam-module";
            $pdata["test_no"] = $this->input->get('id');
            
            $pdata["reading"] = $this->WebRegistrationModel->getSingleData('*',"rt_id='$id'",'exam_reading_test');
            $pdata["reading_sec_answer_1"] = $this->WebRegistrationModel->getdata('*',"rt_id='$id' AND rt_sec_id='1'",'exam_reading_test_correct_answer');
            $pdata["reading_sec_answer_2"] = $this->WebRegistrationModel->getdata('*',"rt_id='$id' AND rt_sec_id='2'",'exam_reading_test_correct_answer');
            $pdata["reading_sec_answer_3"] = $this->WebRegistrationModel->getdata('*',"rt_id='$id' AND rt_sec_id='3'",'exam_reading_test_correct_answer');
            
            $pdata["listening"] = $this->WebRegistrationModel->getSingleData('*',"lt_id='$id'",'exam_listening_test');
            $pdata["listening_sec_answer_1"] = $this->WebRegistrationModel->getdata('*',"lt_id='$id' AND lt_sec_id='1'",'exam_listening_test_correct_answer');
            $pdata["listening_sec_answer_2"] = $this->WebRegistrationModel->getdata('*',"lt_id='$id' AND lt_sec_id='2'",'exam_listening_test_correct_answer');
            $pdata["listening_sec_answer_3"] = $this->WebRegistrationModel->getdata('*',"lt_id='$id' AND lt_sec_id='3'",'exam_listening_test_correct_answer');
            $pdata["listening_sec_answer_4"] = $this->WebRegistrationModel->getdata('*',"lt_id='$id' AND lt_sec_id='4'",'exam_listening_test_correct_answer');
            
            $pdata["writing"] = $this->WebRegistrationModel->getSingleData('*',"wt_id='$id'",'exam_writing_test');
            $pdata["speaking"] = $this->WebRegistrationModel->getSingleData('*',"st_id='$id'",'exam_speaking_test');
            
            
            $data['data']= $pdata; 
            $this->load->view('Dashboard',$data);
	    }
	    else
	    {
	        redirect('AdminPanel/addmocktestlist');
	    }
	}
	
	public function readingquestionaddpassage()
	{
	    $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Reading Passage Section $sec";      
        $data['subtitle']='Add/Update Reading Passage';
        $data['page_name']= "add-reading-passage";
        $pdata['tid']= $tid;
        $pdata['sec']= $sec;
        
        $result = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test');
        
        if(sizeof($result)>0)
        {
            if($sec=='1')
            {
                $pdata['passage'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_one_question;
            }
            else if($sec=='2')
            {
               $pdata['passage'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_two_question;
            }
            else if($sec=='3')
            {
               $pdata['passage'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_three_question;
            }
        }
        $data['data']= $pdata;
        
        $this->load->view('Dashboard',$data);
	}
	
	public function readingquestionaddpassagesubmit()
	{
	    $tid = $this->input->post('tid');
	    $sec = $this->input->post('sec');
	    $passage = $this->input->post('passage');
	    
        if(isset($tid) && isset($sec) && isset($passage))
        {
            $rt['rt_id'] = $tid;
            $rt['create_date'] = date('Y-m-d H:i:s');;
            $rt['last_update_date'] = date('Y-m-d H:i:s');
            $key="";
            if($sec=='1')
            {
                $rt['sec_one_question'] = $passage; 
                $key="sec_one_question='".htmlentities($passage)."'";
            }
            else if($sec=='2')
            {
               $rt['sec_two_question'] = $passage; 
               $key="sec_two_question='".htmlentities($passage)."'";
            }
            else if($sec=='3')
            {
                $rt['sec_three_question'] = $passage;
                $key="sec_three_question='".htmlentities($passage)."'";
            }
            
		    $this->WebRegistrationModel->insertUpdatedb('exam_reading_test',$rt,$key);
		    
	        $url = base_url()."/index.php/AdminPanel/readingquestionaddanswerform?tid=$tid&&sec=$sec";
	        redirect($url);
		    
        }
        
	}
	
	public function readingquestionaddanswerform()
	{  $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Reading Passage Answer Section $sec";      
        $data['subtitle']='Add/Update Reading Passage Answer';
        $data['page_name']= "admin-question-answer";
        $pdata['tid']= $tid;
        $pdata['sec']= $sec;
        $pdata['url']= base_url()."/index.php/AdminPanel/readingquestionaddanswerformpop?tid=$tid&&sec=$sec";
        $pdata['rurl']= base_url()."/index.php/AdminPanel/mocktestmodules?id=$tid";
        $data['data']= $pdata;
        $this->load->view('Dashboard',$data);
	}
	
	public function readingquestionaddanswerformpop()
	{
        $data = array();
        $tid =  $this->input->get('tid');
        $sec =  $this->input->get('sec');
        $data['title']="Reading Passage Answer Form Section $sec";      
        $data['subtitle']='Add/Update Reading Passage Answer Form';
        $data['page_name']= "add-reading-answer-from";
        $data["tid"] =$tid;
        $data["sec"] =$sec;
        
        $result = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test');
        
        if(sizeof($result)>0)
        {
            if($sec=='1')
            {
                $data['passage'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_one_answer_paper;
            }
            else if($sec=='2')
            {
               $data['passage'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_two_answer_paper;
            }
            else if($sec=='3')
            {
               $data['passage'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_three_answer_paper;
            }
        }
        
        //$data['data']= $pdata; 
        $this->load->view('add-reading-answer-from',$data);
        
	}
	
	
	public function readingquestionaddpassageformsubmit()
	{
	    $tid = $this->input->post('tid');
	    $sec = $this->input->post('sec');
	    $passage = $this->input->post('form');
	    
        if(isset($tid) && isset($sec) && isset($passage))
        {
            $rt['rt_id'] = $tid;
            $rt['create_date'] = date('Y-m-d H:i:s');;
            $rt['last_update_date'] = date('Y-m-d H:i:s');
            $key="";
            if($sec=='1')
            {
                $rt['sec_one_answer_paper'] = $passage; 
                $key="sec_one_answer_paper='".htmlentities($passage)."'";
            }
            else if($sec=='2')
            {
               $rt['sec_two_answer_paper'] = $passage; 
               $key="sec_two_answer_paper='".htmlentities($passage)."'";
            }
            else if($sec=='3')
            {
                $rt['sec_three_answer_paper'] = $passage;
                $key="sec_three_answer_paper='".htmlentities($passage)."'";
            }
            
		    $this->WebRegistrationModel->insertUpdatedb('exam_reading_test',$rt,$key);
	        $url = base_url()."/index.php/AdminPanel/readingquestionaddanswer?tid=$tid&&sec=$sec";
	        redirect($url);
		    
        }
        
	}
	
	public function readingquestionpreview()
	{
	    $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Reading Section Preview";      
        $data['subtitle']='Reading Section Preview';
        $data['page_name']= "admin-reading-preview";
        $data['tid']= $tid;
        
        
        $result = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test');
        if(sizeof($result)>0)
        {
            $pdata['canswer_1']= $this->WebRegistrationModel->getdata('*',"rt_id='$tid' AND rt_sec_id='1'",'exam_reading_test_correct_answer');
            $pdata['canswer_2']= $this->WebRegistrationModel->getdata('*',"rt_id='$tid' AND rt_sec_id='2'",'exam_reading_test_correct_answer');
            $pdata['canswer_3']= $this->WebRegistrationModel->getdata('*',"rt_id='$tid' AND rt_sec_id='3'",'exam_reading_test_correct_answer');
           // if($sec=='1')
            {
                $pdata['question_1'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_one_question;
                $pdata['answer_1'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_one_answer_paper;
            }
            //else if($sec=='2')
            {
                $pdata['question_2'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_two_question;
                $pdata['answer_2'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_two_answer_paper;
            }
            //else if($sec=='3')
            {
               $pdata['question_3'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_three_question;
               $pdata['answer_3'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_three_answer_paper;
            }
            $data['data']=$pdata;
        }
        
        $this->load->view('Dashboard',$data);
	}
	
	
	public function listeningquestionpreview()
	{
	    $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Listening Section Preview";      
        $data['subtitle']='Listening Section Preview';
        $data['page_name']= "admin-listening-preview";
        $data['tid']= $tid;
        
        
        $result = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test');
        if(sizeof($result)>0)
        {
            $pdata['canswer_1']= $this->WebRegistrationModel->getdata('*',"lt_id='$tid' AND lt_sec_id='1'",'exam_listening_test_correct_answer');
            $pdata['canswer_2']= $this->WebRegistrationModel->getdata('*',"lt_id='$tid' AND lt_sec_id='2'",'exam_listening_test_correct_answer');
            $pdata['canswer_3']= $this->WebRegistrationModel->getdata('*',"lt_id='$tid' AND lt_sec_id='3'",'exam_listening_test_correct_answer');
            $pdata['canswer_4']= $this->WebRegistrationModel->getdata('*',"lt_id='$tid' AND lt_sec_id='4'",'exam_listening_test_correct_answer');
           // if($sec=='1')
            {
                $test = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test');
                $pdata['answer_1'] = $test->sec_one_answer_paper;
            }
            //else if($sec=='2')
            {
                $pdata['answer_2'] = $test->sec_two_answer_paper;
            }
            //else if($sec=='3')
            {
               $pdata['answer_3'] = $test->sec_three_answer_paper;
            }
            $pdata['lt_file_path'] = $test->lt_file_path;
            $data['data']=$pdata;
        }
        
        $this->load->view('Dashboard',$data);
	}
	
	
	public function writingquestionpreview()
	{
	    $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Writing Section Preview";      
        $data['subtitle']='Writing Section Preview';
        $data['page_name']= "admin-writing-preview";
        $data['tid']= $tid;
        
        
        $result = $this->WebRegistrationModel->getSingleData('*',"wt_id=$tid",'exam_writing_test');
        if(sizeof($result)>0)
        {
            $pdata['question_1'] = $result->sec_one_question;
            $pdata['question_2'] = $result->sec_two_question;
            $data['data']=$pdata;
        }
        
        $this->load->view('Dashboard',$data);
	}
	
	public function speakingquestionpreview()
	{
	    $tid = $this->input->get('tid');
	    $data = array();
        $data['title']="Speaking Section Preview";      
        $data['subtitle']='Speaking Section Preview';
        $data['page_name']= "admin-speaking-preview";
        $data['tid']= $tid;
        
        
        $result = $this->WebRegistrationModel->getSingleData('*',"st_id=$tid",'exam_speaking_test');
        if(sizeof($result)>0)
        {
            $pdata['question_1'] = $result->sec_one_question;
            $pdata['question_2'] = $result->sec_two_question;
            $pdata['question_3'] = $result->sec_three_question;
            $data['data']=$pdata;
        }
        
        $this->load->view('Dashboard',$data);
	}
	
	
	public function listeningquestionaddpassageformsubmit()
	{
	    $tid = $this->input->post('tid');
	    $sec = $this->input->post('sec');
	    $passage = $this->input->post('form');
	    
        if(isset($tid) && isset($sec) && isset($passage))
        {
            $rt['lt_id'] = $tid;
            $rt['create_date'] = date('Y-m-d H:i:s');;
            $rt['last_update_date'] = date('Y-m-d H:i:s');
            $key="";
            if($sec=='1')
            {
                $rt['sec_one_answer_paper'] = $passage; 
                $key="sec_one_answer_paper='".htmlentities($passage)."'";
            }
            else if($sec=='2')
            {
               $rt['sec_two_answer_paper'] = $passage; 
               $key="sec_two_answer_paper='".htmlentities($passage)."'";
            }
            else if($sec=='3')
            {
                $rt['sec_three_answer_paper'] = $passage;
                $key="sec_three_answer_paper='".htmlentities($passage)."'";
            }
            else if($sec=='4')
            {
                $rt['sec_four_answer_paper'] = $passage;
                $key="sec_four_answer_paper='".htmlentities($passage)."'";
            }
            
		    $this->WebRegistrationModel->insertUpdatedb('exam_listening_test',$rt,$key);
	        $url = base_url()."/index.php/AdminPanel/listeningquestionaddanswer?tid=$tid&&sec=$sec";
	        redirect($url);
		    
        }
        
	}
	
	public function listeningquestionaddanswer()
	{
	    $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Reading Passage Answer Section $sec";      
        $data['subtitle']='Add/Update Reading Passage Answer';
        $data['page_name']= "admin-question-answer";
        $pdata['tid']= $tid;
        $pdata['sec']= $sec;
        $pdata['url']= base_url()."/index.php/AdminPanel/listeningquestionanswerpanel?tid=$tid&&sec=$sec";
        $pdata['rurl']= base_url()."/index.php/AdminPanel/mocktestmodules?id=$tid";
        $data['data']= $pdata;
        $this->load->view('Dashboard',$data);
	}
	
	public function listeningquestionanswerpanel()
	{
	    $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Reading Passage Answer Section $sec";      
        $data['subtitle']='Add/Update Reading Passage Answer';
        $data['page_name']= "add-listening-answer";
        $data['tid']= $tid;
        $data['sec']= $sec;
        
        
        $result = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test');
        if(sizeof($result)>0)
        {
            $data['canswer']= $this->WebRegistrationModel->getdata('*',"lt_id='$tid' AND lt_sec_id='$sec'",'exam_listening_test_correct_answer');
            if($sec=='1')
            {
                $data['answer'] = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test')->sec_one_answer_paper;
            }
            else if($sec=='2')
            {
                $data['answer'] = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test')->sec_two_answer_paper;
            }
            else if($sec=='3')
            {
               $data['answer'] = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test')->sec_three_answer_paper;
            }
            else if($sec=='4')
            {
               $data['answer'] = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test')->sec_four_answer_paper;
            }
        }
        //print_r($data['canswer']);
        $this->load->view('add-listening-c-answer',$data);
	}
	
	
	public function readingquestionaddanswer()
	{
	    $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Reading Passage Answer Section $sec";      
        $data['subtitle']='Add/Update Reading Passage Answer';
        $data['page_name']= "admin-question-answer";
        $pdata['tid']= $tid;
        $pdata['sec']= $sec;
        $pdata['url']= base_url()."/index.php/AdminPanel/readingquestionanswerpanel?tid=$tid&&sec=$sec";
        $pdata['rurl']= base_url()."/index.php/AdminPanel/mocktestmodules?tid=$tid";
        $data['data']= $pdata;
        $this->load->view('Dashboard',$data);
	}
	
	public function readingquestionanswerpanel()
	{
	    $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Reading Passage Answer Section $sec";      
        $data['subtitle']='Add/Update Reading Passage Answer';
        $data['page_name']= "add-reading-answer";
        $data['tid']= $tid;
        $data['sec']= $sec;
        
        
        $result = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test');
        if(sizeof($result)>0)
        {
            $data['canswer']= $this->WebRegistrationModel->getdata('*',"rt_id='$tid' AND rt_sec_id='$sec'",'exam_reading_test_correct_answer');
            if($sec=='1')
            {
                $data['question'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_one_question;
                $data['answer'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_one_answer_paper;
            }
            else if($sec=='2')
            {
                $data['question'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_two_question;
                $data['answer'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_two_answer_paper;
            }
            else if($sec=='3')
            {
               $data['question'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_three_question;
               $data['answer'] = $this->WebRegistrationModel->getSingleData('*',"rt_id=$tid",'exam_reading_test')->sec_three_answer_paper;
            }
        }
        
        $this->load->view('add-reading-answer',$data);
	}
	
	
	public function addanswersubmit()
	{
	    $tid = $this->input->post('tid');
        $sec = $this->input->post('sec');
        $final_answer = $this->input->post('final_answer');
	   
        $ertca['rt_id'] = $tid;
        $ertca['rt_sec_id'] = $sec;
        
        
        $this->WebRegistrationModel->deleteDb('exam_reading_test_correct_answer',$ertca);
        
        $ertca['last_update'] = date('Y-m-d H:i:s');
        $count = 1;
        foreach ($final_answer as &$value) 
        {
            $ertca['rt_q_no'] = $count;    
            $ertca['rt_q_ans'] = $value;
            $key="rt_q_ans='$value'";
            $this->WebRegistrationModel->insertUpdatedb('exam_reading_test_correct_answer',$ertca,$key);
            $count++;
        }
       echo "<script>var daddy = window.self;
            daddy.opener = window.self;
            daddy.close();</script>";
            
            $url = base_url()."/index.php/AdminPanel/readingquestionanswerpanel?tid=$tid";
            
            //redirect($url);
	}
	
	public function addlisteninganswersubmit()
	{
	    $tid = $this->input->post('tid');
        $sec = $this->input->post('sec');
        $final_answer = $this->input->post('final_answer');
	   
        $ertca['lt_id'] = $tid;
        $ertca['lt_sec_id'] = $sec;
        
        
        $this->WebRegistrationModel->deleteDb('exam_listening_test_correct_answer',$ertca);
        
        $ertca['last_update'] = date('Y-m-d H:i:s');
        $count = 1;
        foreach ($final_answer as &$value) 
        {
            $ertca['lt_q_no'] = $count;    
            $ertca['lt_q_ans'] = $value;
            $key="lt_q_ans='$value'";
            $this->WebRegistrationModel->insertUpdatedb('exam_listening_test_correct_answer',$ertca,$key);
            $count++;
        }
       echo "<script>var daddy = window.self;
            daddy.opener = window.self;
            daddy.close();</script>";
            
            $url = base_url()."/index.php/AdminPanel/readingquestionanswerpanel?tid=$tid";
            
            //redirect($url);
	}
	
	public function addmocktestlist()
	{
	    $data = array();
        $data['title']='Mock Test';      
        $data['subtitle']='All Mock Test List';
        $data['page_name']= "mock-test-list";
        $data['data']= $this->WebRegistrationModel->getdata('*',"1=1",'exam_mocktest');
        $this->load->view('Dashboard',$data);
	}
	
	public function allfilelist()
	{
	    $data = array();
        $data['title']='File';      
        $data['subtitle']='All File List';
        $data['page_name']= "file-list";
        $data['data']= $this->WebRegistrationModel->getdata('*',"1=1",'exam_files');
        $this->load->view('Dashboard',$data);
	}
	
	public function filesubmit()
	{
	    $file_name = $this->input->post('file_name');
	    $rurl = $this->input->post('rurl');
	    $tid = $this->input->post('tid');
	    $this->load->helper(array('form', 'url','string')); 
	    
        $config['upload_path']   = './uploads/'; 
        $config['allowed_types'] = 'gif|jpg|png|mp3';  
        
        $new_name = time().random_string('alnum', 16);
        $config['file_name'] = $new_name;
        
        $this->load->library('upload', $config);
        
        
        
        if ( ! $this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors()); 
            echo $error['error'];
        }
        
        else 
		{ 
            $data = array('upload_data' => $this->upload->data());  
            $fl_name['fl_name'] = $file_name;
            $fl_name['fl_path'] = base_url()."/uploads/".$data['upload_data']['orig_name'];
            $fl_name['fl_size'] = $data['upload_data']['file_size'];
            $fl_name['fl_type'] = $data['upload_data']['file_type'];
            $fl_name['last_update'] = date('Y-m-d H:i:s');
            
            $this->WebRegistrationModel->insertDb('exam_files',$fl_name);
            
            if(isset($tid))
            {
                $rt['lt_id'] = $tid;
                $rt['lt_file_path'] = base_url()."/uploads/".$data['upload_data']['orig_name'];
                $key="lt_file_path='".base_url()."/uploads/".$data['upload_data']['orig_name']."'";
		        $this->WebRegistrationModel->insertUpdatedb('exam_listening_test',$rt,$key);
            }
            redirect($rurl);
        } 
	}
	
	public function deletefile()
	{
	    $fid = $this->input->get('fl_id');
	    $tid = $this->input->get('mt_id');
	    $f['fl_id'] = $fid;
        if($fid>0)
        {
            $this->WebRegistrationModel->deleteDb('exam_files',$f);
            if(isset($tid) && $tid>0)
            {
                
            }
            else
            {
                redirect(base_url()."/index.php/AdminPanel/allfilelist");
            }
        }
	}
	
	public function deletefilelistening()
	{
	    $tid = $this->input->get('t_id');
	    $f['lt_id'] = $tid;
	    $f['lt_file_path']='';
        if($tid>0)
        {
            $key="lt_file_path=''";
            $this->WebRegistrationModel->insertUpdatedb('exam_listening_test',$f,$key);
            redirect(base_url()."/index.php/AdminPanel/mocktestmodules?id=$tid");
        }
	}
	
	
	public function listeningquestionaddpassage()
	{
	    $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Listening Section $sec";      
        $data['subtitle']='Add/Update Answer Sheet';
        $data['page_name']= "add-listening-answer";
        $pdata['tid']= $tid;
        $pdata['sec']= $sec;
        
        $result = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test');
        
        if(sizeof($result)>0)
        {
            if($sec=='1')
            {
                $pdata['answer'] = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test')->sec_one_answer_paper;
            }
            else if($sec=='2')
            {
               $pdata['answer'] = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test')->sec_two_answer_paper;
            }
            else if($sec=='3')
            {
               $pdata['answer'] = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test')->sec_three_answer_paper;
            }
            else if($sec=='4')
            {
               $pdata['answer'] = $this->WebRegistrationModel->getSingleData('*',"lt_id=$tid",'exam_listening_test')->sec_four_answer_paper;
            }
        }
        $data['data']= $pdata;
        $this->load->view('Dashboard',$data);
	}
	
	
	public function writingquestionaddpassage()
	{
	    $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Writing Question $sec";      
        $data['subtitle']='Add/Update Question';
        $data['page_name']= "add-writing-question";
        $pdata['tid']= $tid;
        $pdata['sec']= $sec;
        
        $result = $this->WebRegistrationModel->getSingleData('*',"wt_id=$tid",'exam_writing_test');
        
        if(sizeof($result)>0)
        {
            if($sec=='1')
            {
                $pdata['passage'] = $this->WebRegistrationModel->getSingleData('*',"wt_id=$tid",'exam_writing_test')->sec_one_question;
            }
            else if($sec=='2')
            {
               $pdata['passage'] = $this->WebRegistrationModel->getSingleData('*',"wt_id=$tid",'exam_writing_test')->sec_two_question;
            }
        }
        $data['data']= $pdata;
        
        $this->load->view('Dashboard',$data);
	}
	
	public function writingquestionaddpassagesubmit()
	{
	    $tid = $this->input->post('tid');
	    $sec = $this->input->post('sec');
	    $passage = $this->input->post('passage');
	    
        if(isset($tid) && isset($sec) && isset($passage))
        {
            $rt['wt_id'] = $tid;
            $rt['create_date'] = date('Y-m-d H:i:s');;
            $rt['last_update_date'] = date('Y-m-d H:i:s');
            $key="";
            if($sec=='1')
            {
                $rt['sec_one_question'] = $passage; 
                $key="sec_one_question='".htmlentities($passage)."'";
            }
            else if($sec=='2')
            {
               $rt['sec_two_question'] = $passage; 
               $key="sec_two_question='".htmlentities($passage)."'";
            }
            
		    $this->WebRegistrationModel->insertUpdatedb('exam_writing_test',$rt,$key);
		    
	        $url = base_url()."/index.php/AdminPanel/mocktestmodules?id=$tid";
	        redirect($url);
		    
        }
        
	}
	
	
	public function speakingquestionaddpassage()
	{
	    $tid = $this->input->get('tid');
        $sec = $this->input->get('sec');
	    $data = array();
        $data['title']="Speaking Question $sec";      
        $data['subtitle']='Add/Update Question';
        $data['page_name']= "add-speaking-question";
        $pdata['tid']= $tid;
        $pdata['sec']= $sec;
        
        $result = $this->WebRegistrationModel->getSingleData('*',"st_id=$tid",'exam_speaking_test');
        
        if(sizeof($result)>0)
        {
            if($sec=='1')
            {
                $pdata['passage'] = $this->WebRegistrationModel->getSingleData('*',"st_id=$tid",'exam_speaking_test')->sec_one_question;
            }
            else if($sec=='2')
            {
               $pdata['passage'] = $this->WebRegistrationModel->getSingleData('*',"st_id=$tid",'exam_speaking_test')->sec_two_question;
            }
            else if($sec=='3')
            {
               $pdata['passage'] = $this->WebRegistrationModel->getSingleData('*',"st_id=$tid",'exam_speaking_test')->sec_three_question;
            }
        }
        $data['data']= $pdata;
        
        $this->load->view('Dashboard',$data);
	}
	
	public function speakingquestionaddpassagesubmit()
	{
	    $tid = $this->input->post('tid');
	    $sec = $this->input->post('sec');
	    $passage = $this->input->post('passage');
	    
        if(isset($tid) && isset($sec) && isset($passage))
        {
            $rt['st_id'] = $tid;
            $rt['create_date'] = date('Y-m-d H:i:s');;
            $rt['last_update_date'] = date('Y-m-d H:i:s');
            $key="";
            if($sec=='1')
            {
                $rt['sec_one_question'] = $passage; 
                $key="sec_one_question='".htmlentities($passage)."'";
            }
            else if($sec=='2')
            {
               $rt['sec_two_question'] = $passage; 
               $key="sec_two_question='".htmlentities($passage)."'";
            }
            else if($sec=='3')
            {
               $rt['sec_three_question'] = $passage; 
               $key="sec_three_question='".htmlentities($passage)."'";
            }
            else
            {
                $url = base_url()."/index.php/AdminPanel/mocktestmodules?id=$tid";
            }
		    $this->WebRegistrationModel->insertUpdatedb('exam_speaking_test',$rt,$key);
		    
	        $url = base_url()."/index.php/AdminPanel/mocktestmodules?id=$tid";
	        redirect($url);
		    
        }
        
	}
	
	public function sign_out()
	{
	    $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        
        if(empty($id))
        {
           $this->session->sess_destroy(); 
        }
        redirect('', 'refresh');
        
	}
	
	public function signin()
	{
		$data['header']='Krishibid';
		$data['title']='Krishibid';
		
		$sess_id = $this->session->userdata('id');

        if(empty($sess_id))
		{
		   // $this->session->sess_destroy();
    		$user_name = $this->input->post('user_name');
    		$user_password = $this->input->post('user_password');
    		if(isset($user_name) && isset($user_password))
    		{
    		    $table ='user_details';
        		$where = array('user_name' => $user_name ,'user_password' => $user_password , 'active_status' => '1');
        		$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
        		
        		if(sizeof($result) > 0)
        		{
        		    $newdata = array(
                            'id'  => $result->id,
                            'user_name'  => $result->user_name,
                            'user_password'     => $result->user_password,
                            'user_catagory'     => $result->user_catagory
                        );
                    $this->session->set_userdata($newdata);
                    redirect('dashboard', 'refresh');
        		}
        		else
        		{
                    $data = array();
                    $data['header']='Krishibid';      
                    $data['title']='Krishibid';
                    $data['msg'] = 'User not Found';
                    $data['target']='signin';
                    $data['user_name'] = $user_name;
                    $this->load->view('Signin', $data);
        		}   
    		}
		}
		else
		{
		   redirect('dashboard', 'refresh');
		}
	}
	
	public function member_details()
	{
        $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        $member_id = $this->input->get('id');
        
        
        if(isset($member_id))
		{
			$where = array('member_id' => $member_id);
			$table ='member_info';
			$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
			if(isset($result->member_id))
			{
				$data = array();
				$data['header']='Krishibid';      
				$data['title']='Krishibid';
				
				$table ='member_info';
				$where = array('member_id' => $member_id);
				$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
				
				$data['member_id'] =  $result->member_id;
				$data['member_type'] =  $result->member_type;
				$data['zone'] = $this->WebRegistrationModel->getSingleData('*','district_id='.$result->zone,'districts')->district_en;
				$data['applicant_name'] = $result->applicant_name;
				$data['childrens'] = $this->WebRegistrationModel->getdata('*','member_id='.$result->id,'childrens');
				$data['applicant_dob']=  $result->applicant_dob;	
				$data['applicant_nid'] = $result->applicant_nid;
				$data['applicant_gender'] = $result->applicant_gender;
				$data['applicant_religion'] = $result->applicant_religion;
				$data['applicant_marital_status'] = $result->applicant_marital_status;
				$data['applicant_blood_group'] = $result->applicant_blood_group;
				$data['applicant_impairment'] = $result->applicant_impairment;
				if($data['applicant_impairment']=='yes')
				{
					$data['applicant_disabilities'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->applicant_disabilities,'physical_disabilities')->disabilities_name;
				}
				$data['degree_name'] = $this->WebRegistrationModel->getSingleData('*','fact_id='.$result->degree_name,'faculty')->fact_name;
				$data['degree_subject'] = $result->degree_subject;
				$data['degree_institute'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->degree_institute,'institute')->institute_name;
				$data['degree_passing_year'] = $result->degree_passing_year;
		
		
				$data['education_level1'] = $result->education_level1;
				$data['additional_degree_name1'] = $result->additional_degree_name1;
				$data['additional_paasing_year1'] = $result->additional_paasing_year1;
				$data['additional_intitute_name1'] = $result->additional_intitute_name1;
		
				$data['education_level2'] = $result->education_level2;
				$data['additional_degree_name2'] = $result->additional_degree_name2;
				$data['additional_paasing_year2'] = $result->additional_paasing_year2;
				$data['additional_intitute_name2'] = $result->additional_intitute_name2;
		
		
		
		
				$data['applicant_profession'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->applicant_profession,'profession')->profession_name;
				$data['present_district'] = $this->WebRegistrationModel->getSingleData('*','district_id='.$result->present_district,'districts')->district_en;
				$data['present_upazilla'] = $this->WebRegistrationModel->getSingleData('*','upazilla_id='.$result->present_upazilla,'upazillas')->upazilla_en;
				$data['present_village'] = $result->present_village;
				$data['present_road'] = $result->present_road;
				$data['present_post_office'] = $result->present_post_office;
				$data['present_post_code'] = $result->present_post_code;
				$data['present_permanent_same'] = $result->present_permanent_same;
		
				$data['permanent_village'] = $result->permanent_village;
				$data['permanent_road'] = $result->permanent_road;
				$data['permanent_post_office'] = $result->permanent_post_office;
				$data['permanent_post_code'] = $result->permanent_post_code;
				$data['permanent_upazilla'] = $this->WebRegistrationModel->getSingleData('*','upazilla_id='.$result->permanent_upazilla,'upazillas')->upazilla_en;
				$data['permanent_district'] =  $this->WebRegistrationModel->getSingleData('*','district_id='.$result->permanent_district,'districts')->district_en;
				$data['mobile'] = $result->mobile;
				$data['email'] = $result->email;
				$data['mothers_name'] = $result->mothers_name;
				$data['fathers_name'] = $result->fathers_name;
				$data['spouse_name'] = $result->spouse_name;
				$data['number_of_children'] = $result->number_of_children;
				$data['applicant_photo_path'] = $result->applicant_photo_path;
				$data['target'] = base_url().'final-submit';				
				////////////////////////////////////
		
				$this->load->view('data-preview', $data);
			}
			else
			{
				redirect('dashboard', 'refresh');
			}	
		}
		else
		{
			redirect('dashboard', 'refresh');
			
		}
        
       // $this->load->view('data-preview', $data);
	}
	
	public function member_edit()
	{
	    $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        $member_id = $this->input->get('id');
		
		if (!(strpos($member_id, '-') !== false))
		{
			$member_id = substr($member_id ,0,2).'-'.substr($member_id ,2,2).'-'.substr($member_id ,4);
		}

        if(isset($member_id))
		{
            $where = array('member_id' => $member_id);
            $table ='member_info';
            $result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
            if(isset($result->member_id))
			{
                
                
                $member_since = explode("-",$result->member_since);				
				if($member_since[2]=='00')
				{
					$data['member_since_day']= '';
				}
				else
				{
					$data['member_since_day']= $member_since[2];
				}
				
				if($member_since[0]=='0000')
				{
					$data['member_since_year']= '';
				}
				else
				{
					$data['member_since_year']= $member_since[0];
				}
				$data['member_id']=  $result->member_id;
                $data['member_type']=  $result->member_type;
                
                $data['member_since_month']= $member_since[1];
                $data['zone'] = $result->zone;
                $data['applicant_name'] = $result->applicant_name;
                $data['zones'] = $this->WebRegistrationModel->getdataOderBy('*','1=1','districts','district_en');
                $data['upazillas'] = $this->WebRegistrationModel->getdata('*','1=1','upazillas');
                $data['faculties'] = $this->WebRegistrationModel->getdata('*','1=1','faculty');
                $data['institutes'] = $this->WebRegistrationModel->getdata('*','1=1','institute');
                $data['professions'] = $this->WebRegistrationModel->getdata('*','1=1','profession');
				$data['physical_disabilities'] = $this->WebRegistrationModel->getdata('*','1=1','physical_disabilities');
				$data['childrens'] = $this->WebRegistrationModel->getdata('*','member_id='.$result->id,'childrens');
                $applicant_dob = explode("-",$result->applicant_dob);
				$data['applicant_dob_month']= $applicant_dob[1];
				if($applicant_dob[2]=='00')
				{
					$data['applicant_dob_day']= '';
				}
				else
				{
					$data['applicant_dob_day']= $applicant_dob[2];
				}
				
				if($applicant_dob[0]=='0000')
				{
					$data['applicant_dob_year']= '';
				}
				else
				{
					$data['applicant_dob_year']= $applicant_dob[0];
				}

                $data['applicant_nid'] = $result->applicant_nid;
                $data['applicant_gender'] = $result->applicant_gender;
                $data['applicant_religion'] = $result->applicant_religion;
                $data['applicant_marital_status'] = $result->applicant_marital_status;
                $data['applicant_blood_group'] = $result->applicant_blood_group;
                $data['applicant_impairment'] = $result->applicant_impairment;
                $data['applicant_disabilities'] = $result->applicant_disabilities;
                $data['degree_name'] = $result->degree_name;
                $data['degree_subject'] = $result->degree_subject;
                $data['degree_institute'] = $result->degree_institute;
                $data['degree_passing_year'] = $result->degree_passing_year;
                
                
                $data['education_level1'] = $result->education_level1;
                $data['additional_degree_name1'] = $result->additional_degree_name1;
                $data['additional_paasing_year1'] = $result->additional_paasing_year1;
                $data['additional_intitute_name1'] = $result->additional_intitute_name1;
                
                $data['education_level2'] = $result->education_level2;
                $data['additional_degree_name2'] = $result->additional_degree_name2;
                $data['additional_paasing_year2'] = $result->additional_paasing_year2;
                $data['additional_intitute_name2'] = $result->additional_intitute_name2;
                
                
                
                
                $data['applicant_profession'] = $result->applicant_profession;
                $data['present_district'] = $result->present_district;
                $data['present_upazilla'] = $result->present_upazilla;
                $data['present_village'] = $result->present_village;
                $data['present_road'] = $result->present_road;
                $data['present_post_office'] = $result->present_post_office;
                $data['present_post_code'] = $result->present_post_code;
                $data['present_permanent_same'] = $result->present_permanent_same;

                $data['permanent_village'] = $result->permanent_village;
                $data['permanent_road'] = $result->permanent_road;
                $data['permanent_post_office'] = $result->permanent_post_office;
                $data['permanent_post_code'] = $result->permanent_post_code;
                $data['permanent_upazilla'] = $result->permanent_upazilla;
                $data['permanent_district'] = $result->permanent_district;
                $data['mobile'] = $result->mobile;
                $data['email'] = $result->email;
                $data['mothers_name'] = $result->mothers_name;
                $data['fathers_name'] = $result->fathers_name;
                $data['spouse_name'] = $result->spouse_name;
                $data['number_of_children'] = $result->number_of_children;
				$data['target'] = base_url().'index.php/submit';
                $this->load->view('registration', $data);
			
			}
		}
		else
		{
            redirect('', 'refresh');
		}
	}
	

	public function data_submit()
	{
	    $data = array();
		$member_id= $this->input->post('member_id');
		$member_type= $this->input->post('member_type');
		$a = $this->input->post('applicant_name');
		
		$table ='member_info';
		$where = array('member_id' => $member_id);
		$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
		$id = $result->id;
		
		if(isset($a))
		{
			$data['member_since']= $this->input->post('member_since_year').'-'.$this->input->post('member_since_month').'-'.$this->input->post('member_since_day');

			$data['zone'] = $this->input->post('zone');

			$data['applicant_name'] = $this->input->post('applicant_name');
			

			$this->WebRegistrationModel->deleteDb('childrens','member_id='.$id);
			
			$data['applicant_dob']= $this->input->post('applicant_dob_year').'-'.$this->input->post('applicant_dob_month').'-'.$this->input->post('applicant_dob_day');

			$children_names = $this->input->post('child_name');
			$child_genders = $this->input->post('child_gender');
			
			$count=0;
			if(sizeof($children_names)>0)
			{
				foreach ($children_names as $children_name)
				{
					if($children_name!='')
					{
						$child['member_id'] = $id;
						$child['name'] = $children_name;
						$child['gender'] = $child_genders[$count];			
						$this->WebRegistrationModel->insertDb('childrens',$child);
						$count++;
					}
				}
			}		
			


            $data['member_type'] = $this->input->post('member_type');
			$data['applicant_nid'] = $this->input->post('applicant_nid');
			$data['applicant_gender'] = $this->input->post('applicant_gender');
			$data['applicant_religion'] = $this->input->post('applicant_religion');
			$data['applicant_marital_status'] = $this->input->post('applicant_marital_status');
			$data['applicant_blood_group'] = $this->input->post('applicant_blood_group');
			$data['applicant_impairment'] = $this->input->post('applicant_impairment');
			$data['applicant_disabilities'] = $this->input->post('applicant_disabilities');
			$data['degree_name'] = $this->input->post('degree_name');
			$data['degree_subject'] = $this->input->post('degree_subject');
			$data['degree_institute'] = $this->input->post('degree_institute');
			$data['degree_passing_year'] = $this->input->post('degree_passing_year');


			$data['education_level1'] = $this->input->post('education_level1');
			$data['additional_degree_name1'] = $this->input->post('additional_degree_name1');
			$data['additional_paasing_year1'] = $this->input->post('additional_paasing_year1');
			$data['additional_intitute_name1'] = $this->input->post('additional_intitute_name1');

			$data['education_level2'] = $this->input->post('education_level2');
			$data['additional_degree_name2'] = $this->input->post('additional_degree_name2');
			$data['additional_paasing_year2'] = $this->input->post('additional_paasing_year2');
			$data['additional_intitute_name2'] = $this->input->post('additional_intitute_name2');




			$data['applicant_profession'] = $this->input->post('applicant_profession');

			$data['present_district'] = $this->input->post('present_district');
			$data['present_upazilla'] = $this->input->post('present_upazilla');
			$data['present_village'] = $this->input->post('present_village');
			$data['present_road'] = $this->input->post('present_road');
			$data['present_post_office'] = $this->input->post('present_post_office');
			$data['present_post_code'] = $this->input->post('present_post_code');
			$data['present_permanent_same'] = $this->input->post('present_permanent_same');

			if(isset($_POST['present_permanent_same']))
			{
				$data['present_permanent_same'] = '1';
				$data['permanent_village'] = $this->input->post('present_village');
				$data['permanent_road'] = $this->input->post('present_road');
				$data['permanent_post_office'] = $this->input->post('present_post_office');
				$data['permanent_post_code'] = $this->input->post('present_post_code');
				$data['permanent_upazilla'] = $this->input->post('present_upazilla');
				$data['permanent_district'] = $this->input->post('present_district');
			}
			else
			{
				$data['present_permanent_same'] = '0';
				$data['permanent_village'] = $this->input->post('permanent_village');
				$data['permanent_road'] = $this->input->post('permanent_road');
				$data['permanent_post_office'] = $this->input->post('permanent_post_office');
				$data['permanent_post_code'] = $this->input->post('permanent_post_code');
				$data['permanent_upazilla'] = $this->input->post('permanent_upazilla');
				$data['permanent_district'] = $this->input->post('permanent_district');
			}
			$data['mobile'] = $this->input->post('mobile');
			$data['email'] = $this->input->post('email');
			$data['mothers_name'] = $this->input->post('mothers_name');
			$data['fathers_name'] = $this->input->post('fathers_name');
			$data['spouse_name'] = $this->input->post('spouse_name');
			$data['number_of_children'] = $this->input->post('number_of_children');
			
			
			$tableTemplate ='member_info';
			$whereTemplate = array('member_id' => $member_id);
			$resultTemplate = $this->WebRegistrationModel->getSingleData('*',$whereTemplate,$tableTemplate);
			
			
			$where = array('member_id' => $member_id);
			$result = $this->WebRegistrationModel->updateDb('member_info',$where,$data);
			
			
			$table ='member_info';
			$where = array('member_id' => $member_id);
			$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);	
			
			echo "<script>window.close();</script>";
			
			
		}
		else
		{
			redirect('', 'refresh');
		}
	}
	
	public function approve_member()
	{
        $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        $data['page']='approve';
        $member_id = $this->input->get('member_id');
        if(isset($member_id))
        {
            $data['page']= $this->input->get('page');
        }
        else
        {
            $member_id = $this->input->post('member_id');
        }
		
		if(isset($member_id))
		{
		    if (!(strpos($member_id, '-') !== false))
            {
            	$member_id = substr($member_id ,0,2).'-'.substr($member_id ,2,2).'-'.substr($member_id ,4);
            }  
            $where = array('member_id' => $member_id,'application_status' => '3');
		}
		else
		{
		   $where = array('application_status' => '3','approve_status' => '0'); 
		}
		
		$table ='member_info';
		$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
		
		if(isset($result->member_id))
		{
			//$data = array();
			//$data['header']='Krishibid';      
			//$data['title']='Krishibid';
			
			$table ='member_info';
			$member_id =  $result->member_id;
			$where = array('member_id' => $member_id);
			$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
			
			$data['id'] = $result->id;
			$data['member_id'] =  $result->member_id;
			$data['member_type'] =  $result->member_type;
			$data['zone'] = $this->WebRegistrationModel->getSingleData('*','district_id='.$result->zone,'districts')->district_en;
			$data['applicant_name'] = $result->applicant_name;
			$data['childrens'] = $this->WebRegistrationModel->getdata('*','member_id='.$result->id,'childrens');
			$data['applicant_dob']=  $result->applicant_dob;	
			$data['applicant_nid'] = $result->applicant_nid;
			$data['applicant_gender'] = $result->applicant_gender;
			$data['applicant_religion'] = $result->applicant_religion;
			$data['applicant_marital_status'] = $result->applicant_marital_status;
			$data['applicant_blood_group'] = $result->applicant_blood_group;
			$data['applicant_impairment'] = $result->applicant_impairment;
			if($data['applicant_impairment']=='yes')
			{
			    if(isset($this->WebRegistrationModel->getSingleData('*','id='.$result->applicant_disabilities,'physical_disabilities')->disabilities_name))
				{
				    $data['applicant_disabilities'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->applicant_disabilities,'physical_disabilities')->disabilities_name;
				}
			}
			$data['degree_name'] = $this->WebRegistrationModel->getSingleData('*','fact_id='.$result->degree_name,'faculty')->fact_name;
			$data['degree_subject'] = $result->degree_subject;
			$data['degree_institute'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->degree_institute,'institute')->institute_name;
			$data['degree_passing_year'] = $result->degree_passing_year;
	
	
			$data['education_level1'] = $result->education_level1;
			$data['additional_degree_name1'] = $result->additional_degree_name1;
			$data['additional_paasing_year1'] = $result->additional_paasing_year1;
			$data['additional_intitute_name1'] = $result->additional_intitute_name1;
	
			$data['education_level2'] = $result->education_level2;
			$data['additional_degree_name2'] = $result->additional_degree_name2;
			$data['additional_paasing_year2'] = $result->additional_paasing_year2;
			$data['additional_intitute_name2'] = $result->additional_intitute_name2;
	
			$data['applicant_profession'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->applicant_profession,'profession')->profession_name;
			$data['present_district'] = $this->WebRegistrationModel->getSingleData('*','district_id='.$result->present_district,'districts')->district_en;
			$data['present_upazilla'] = $this->WebRegistrationModel->getSingleData('*','upazilla_id='.$result->present_upazilla,'upazillas')->upazilla_en;
			$data['present_village'] = $result->present_village;
			$data['present_road'] = $result->present_road;
			$data['present_post_office'] = $result->present_post_office;
			$data['present_post_code'] = $result->present_post_code;
			$data['present_permanent_same'] = $result->present_permanent_same;
	
			$data['permanent_village'] = $result->permanent_village;
			$data['permanent_road'] = $result->permanent_road;
			$data['permanent_post_office'] = $result->permanent_post_office;
			$data['permanent_post_code'] = $result->permanent_post_code;
			$data['permanent_upazilla'] = $this->WebRegistrationModel->getSingleData('*','upazilla_id='.$result->permanent_upazilla,'upazillas')->upazilla_en;
			$data['permanent_district'] =  $this->WebRegistrationModel->getSingleData('*','district_id='.$result->permanent_district,'districts')->district_en;
			$data['mobile'] = $result->mobile;
			$data['email'] = $result->email;
			$data['mothers_name'] = $result->mothers_name;
			$data['fathers_name'] = $result->fathers_name;
			$data['spouse_name'] = $result->spouse_name;
			$data['number_of_children'] = $result->number_of_children;
			$data['applicant_photo_path'] = $result->applicant_photo_path;
			$data['submission_date'] = $result->submission_date;				
			////////////////////////////////////
			
			$where = array('mem_no' => $member_id);
    		$table ='tbl_member';
    		$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
    		
    		if(isset($result->mem_no))
    		{
                $data['old_mem_no'] = $result->mem_no;
                $data['old_mem_name'] = $result->mem_name;
                $data['old_father_name'] = $result->father_name;
                $data['old_mother_name'] = $result->mother_name;
                $data['old_hus_name'] = $result->hus_name;
                $data['old_dob'] = $result->dob;
                $data['old_mem_graduate'] = $result->mem_graduate;
                $data['old_gr_unv'] = $result->gr_unv;
                $data['old_gr_year'] = $result->gr_year;
                
                $data['old_per_dist_id'] = $result->per_dist_id;
                $dis = $this->WebRegistrationModel->getSingleData('*','dist_id='.$result->per_dist_id,'tbl_district');
                
                if(isset($dis->dist_name))
				{
				    $data['old_per_dist_id'] = $dis->dist_name;
				}
				
				$data['old_per_upz_id'] = $result->per_upz_id;
				$dis = $this->WebRegistrationModel->getSingleData('*','dist_id='.$result->per_dist_id." AND upz_id=".$result->per_upz_id,'tbl_upazilla');
                if(isset($dis->upz_name))
				{
				    $data['old_per_upz_id'] = $dis->upz_name;
				}
				
				if($data['old_per_upz_id']=='0'){$data['old_per_upz_id']='N/A';}
				if($data['old_per_dist_id']=='0'){$data['old_per_dist_id']='N/A';}
                
                $data['old_per_post_off'] = $result->per_post_off;
                $data['old_per_addr'] = $result->per_addr;
                
    		}
	        ////////////////
	        
            $where = array('application_status' => '3','approve_status' => '0'); 
            $table ='member_info';
            $result1 = $this->WebRegistrationModel->getdata('*',$where,$table);
            $data['pending_data'] = sizeof($result1);
                
            $this->load->view('Approval', $data);
		}
		else
		{
		    $data['member_id']=$member_id;
		    $data['msg'] = 'Member not Registrated';
		    $this->load->view('Approval', $data);
		}
       
	}
	
	public function approve_member_individual()
	{
	    $id = $this->session->userdata('id');
        $user_name = $this->session->userdata('user_name');
        $user_password = $this->session->userdata('user_password');
        $user_catagory = $this->session->userdata('user_catagory');
        
        $data = array();
		$data['approve_status'] = '1';
		$data['approve_by'] = $id;
		$data['approve_date'] = date('Y-m-d H:i:s');
		
		$mid = $this->input->get('id');
		$member_id = $this->input->get('member_id');
		$page = $this->input->get('page');
		
        $where = array('id' => $mid ,'member_id' => $member_id);
		$this->WebRegistrationModel->updateDb('member_info',$where,$data);
		
		if($page==''){
		    echo "<script>window.close();</script>";
		}
	    else{
	        redirect($page, 'refresh');
	    }
	}
	public function reject_member_individual()
	{
	    $id = $this->session->userdata('id');
        $user_name = $this->session->userdata('user_name');
        $user_password = $this->session->userdata('user_password');
        $user_catagory = $this->session->userdata('user_catagory');
        
        $data = array();
		$data['approve_status'] = '2';
		$data['approve_by'] = $id;
		$data['approve_date'] = date('Y-m-d H:i:s');
		
		$mid = $this->input->get('id');
		$member_id = $this->input->get('member_id');
		$page = $this->input->get('page');
		
        $where = array('id' => $mid ,'member_id' => $member_id);
		$this->WebRegistrationModel->updateDb('member_info',$where,$data);
		
	    if($page==''){
		    echo "<script>window.close();</script>";
		}
	    else{
	        redirect($page, 'refresh');
	    }
	}
	
	public function reject_list()
	{
        $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        $data['target']='index.php/AdminPanel/signin';
        
        $where = array('approve_status' => '2'); 
        $table ='member_info';
        $result = $this->WebRegistrationModel->getdata('*',$where,$table);
        $data['members'] = $result;
        $data['members_size'] = sizeof($result);
            
		$this->load->view('RejectList', $data);
	}
	
	////////
	
	public function rederror()
	{
		
	}
	
	public function createExam()
	{
		$tid = $this->input->get('tid'); 
		$st_id = $this->session->userdata('st_id');
		
		$log =  $this->WebRegistrationModel->getSingleData('*',"mt_id='$tid' AND st_id='$st_id' AND is_completed='0'",'exam_student_mocktest_log');
		//$log =  $this->WebRegistrationModel->getSingleData('*',"mt_id='$tid' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($log->ex_id))
		{
			$id = $log->ex_id;
			redirect("Exampanel/beginexam?tid=$id", 'refresh');
		}
		else
		{
			$idata = array(
						'st_id'  => $st_id,
						'mt_id'  => $tid,
						'is_completed'  => 0,
						'is_completed'  => 0,
						'start_datetime'  => date('Y-m-d H:i:s')
					  );
			$id =  $this->WebRegistrationModel->insertUpdatedb('exam_student_mocktest_log',$idata,"mt_id='$tid' AND st_id='$st_id' AND is_completed='0'");				
			redirect("Exampanel/beginexam?tid=$id", 'refresh');
		}
		
	}
	
	public function ieltsexam()
	{
		$data = array();
        $data['header']='Online IELTS Exam';      
        $data['title']='Online IELTS Exam';
         
		$tid = $this->input->get('tid'); 
		$st_id = $this->session->userdata('st_id');
		
		if(isset($tid))
		{
			$log =  $this->WebRegistrationModel->getSingleData('*',"ex_id='$tid' AND st_id='$st_id'",'exam_student_mocktest_log');
			if(isset($log->ex_id))
			{
				$exam_data = $this->WebRegistrationModel->getSingleData('*',"mt_id='".$log->mt_id."'",'exam_mocktest');			
				$data["exam_data"] = $exam_data	;
				
				$data["log"] = $log;				
					
				if(isset($log->listening_score) && isset($log->reading_score) && isset($log->writing_score) && isset($log->speaking_score))
				{
					if($log->is_completed=='0' && $log->listening_score!='' && $log->reading_score!='' && $log->writing_score!='' && $log->writing_score!='-1' && $log->speaking_score!='' && $log->speaking_score!='-1')
					{
						$ls = doubleval($log->listening_score);
						$rs = doubleval($log->reading_score);
						$ws = doubleval($log->writing_score);
						$ss = doubleval($log->speaking_score);
						
						$os = ($ls+ $rs+$ws+$ss)/4;
						$rs = "0.0";
						if($os >= 0.75 && $os < 1.25)
						{
							$rs = "1.0";
						}
						if($os >= 1.25 && $os < 1.75)
						{
							$rs = "1.5";
						}
						else if($os >= 1.75 && $os < 2.25)
						{
							$rs = "2.0";
						}
						else if($os >= 2.25 && $os < 2.75)
						{
							$rs = "2.5";
						}
						else if($os >= 2.75 && $os < 3.25)
						{
							$rs = "3.0";
						}
						else if($os >= 3.25 && $os < 3.75)
						{
							$rs = "3.5";
						}
						else if($os >= 3.75 && $os < 4.25)
						{
							$rs = "4.0";
						}
						else if($os >= 4.25 && $os < 4.75)
						{
							$rs = "4.5";
						}
						else if($os >= 4.75 && $os < 5.25)
						{
							$rs = "5.0";
						}
						else if($os >= 5.25 && $os < 5.75)
						{
							$rs = "5.5";
						}
						else if($os >= 5.75 && $os < 6.25)
						{
							$rs = "6.0";
						}
						else if($os >= 6.25 && $os < 6.75)
						{
							$rs = "6.5";
						}
						else if($os >= 6.75 && $os < 7.25)
						{
							$rs = "7.0";
						}
						else if($os >= 7.25 && $os < 7.75)
						{
							$rs = "7.5";
						}
						else if($os >= 7.75 && $os < 8.25)
						{
							$rs = "8.0";
						}
						else if($os >= 8.25 && $os < 9)
						{
							$rs = "8.5";
						}
						else if($os>=9)
						{
							$rs = "9.0";
						}						
						$ld['ex_id']=$log->ex_id;
						$ld['overall_brand']=$rs;
						$ld['is_completed']='1';
						$ld['end_date_time'] = date('Y-m-d H:i:s');
						$this->WebRegistrationModel->insertUpdatedb('exam_student_mocktest_log',$ld,"overall_brand='$rs',is_completed='1',end_date_time='".date('Y-m-d H:i:s')."'");
					    $log =  $this->WebRegistrationModel->getSingleData('*',"ex_id='$tid' AND st_id='$st_id'",'exam_student_mocktest_log');
					    $data["log"] = $log;
					}
				}
				
				$this->load->view('examdashboard', $data);
			}
		}
	}
	
	public function beginexam()
	{
		$mt_id = $this->input->get('tid');
		$st_id = $this->session->userdata('st_id');	
		
		 
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$mt_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		
		if(isset($exam_data->ex_id))
		{	
			if($exam_data->listening_score=='')
			{
				redirect("Exampanel/listeningmoduleinstruction?ex_id=".$exam_data->ex_id, 'refresh');
			}
			else if($exam_data->reading_score=='')
			{
				redirect("Exampanel/readingmoduleinstruction?ex_id=".$exam_data->ex_id, 'refresh');
			}
			else if($exam_data->writing_score=='')
			{
				redirect("Exampanel/writingmodule?ex_id=".$exam_data->ex_id, 'refresh');
			}
			else if($exam_data->speaking_score=='')
			{
				redirect("Exampanel/speakingmodule?ex_id=".$exam_data->ex_id, 'refresh');
			}
			else
			{
				redirect("Exampanel/ieltsexam?tid=$mt_id");
			}
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	public function listeningmoduleinstruction()
	{
	    $ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');	
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{	
			$mt_name = $this->WebRegistrationModel->getSingleData('*',"mt_id='".$exam_data->mt_id."'",'exam_mocktest')->mt_name;
			$l_exam =  $this->WebRegistrationModel->getSingleData('*',"lt_id='".$exam_data->mt_id."'",'exam_listening_test');
			$data['ex_id'] = $ex_id;
			$data['mt_id'] = $exam_data->mt_id;
			$data['mt_name'] = $mt_name;
			$data['data'] = $l_exam;
			$id = $exam_data->mt_id;
			$this->load->view('listening-instruction', $data);
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function listeningmodule()
	{
		$ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');	
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{	
			$mt_name = $this->WebRegistrationModel->getSingleData('*',"mt_id='".$exam_data->mt_id."'",'exam_mocktest')->mt_name;
			$l_exam =  $this->WebRegistrationModel->getSingleData('*',"lt_id='".$exam_data->mt_id."'",'exam_listening_test');
			$data['ex_id'] = $ex_id;
			$data['mt_id'] = $exam_data->mt_id;
			$data['mt_name'] = $mt_name;
			$data['data'] = $l_exam;
			$id = $exam_data->mt_id;
			$this->load->view('listeningexam', $data);
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function submitlistening()
	{
		$ex_id = $this->input->post('ex_id');		
		$mt_id = $this->input->post('mt_id');	
		$final_answer = $this->input->post('final_answer');	
		$st_id = $this->session->userdata('st_id');			
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"mt_id='$mt_id' AND ex_id='$ex_id' AND st_id='$st_id' AND is_completed='0'",'exam_student_mocktest_log');
		if(isset($exam_data))
		{			
			$c_answers = $this->WebRegistrationModel->getdataOrderBy('*',"lt_id='$mt_id'",'exam_listening_test_correct_answer','lt_sec_id,lt_q_no');
			$ans_count=0;
			$mark = 0;
			foreach ($c_answers as &$c_answer) 
			{
				$elt['elt_exam_id'] = $ex_id;
				$elt['elt_question_answer_c'] = $c_answer->lt_q_ans;
				$elt['elt_question_no'] = $ans_count+1;
				$elt['elt_answer'] = $final_answer[$ans_count];
				$elt['elt_if_correct'] = 0;
				$elt['create_date'] =  date('Y-m-d H:i:s');
				
				$cans = trim(strtoupper($c_answer->lt_q_ans));
				$uans = trim(strtoupper($final_answer[$ans_count]));				
				if (in_array($uans, explode("/",$cans)))
				{
					$mark++;
					$elt['elt_if_correct'] = 1;
				}
				
				$id =  $this->WebRegistrationModel->insertUpdatedb('exam_student_listening_answer',$elt,"elt_question_answer_c='".$c_answer->lt_q_ans."', elt_answer='".$final_answer[$ans_count]."', elt_if_correct='".$elt['elt_if_correct']."', create_date='".date('Y-m-d H:i:s')."'");
				
				$ans_count++;
			}
			$band = "0.0";
			if($mark>=4 && $mark <=5)
			{
				$band ="2.5";
			}
			else if($mark>=6 && $mark <=7)
			{
				$band ="3.0";
			}
			else if($mark>=10 && $mark <=8)
			{
				$band ="3.5";
			}
			else if($mark>=11 && $mark <=12)
			{
				$band ="4.0";
			}
			else if($mark>=13 && $mark <=15)
			{
				$band ="4.5";
			}
			else if($mark>=16 && $mark <=17)
			{
				$band ="5.0";
			}
			else if($mark>=18 && $mark <=22)
			{
				$band ="5.5";
			}
			else if($mark>=23 && $mark <=25)
			{
				$band ="6.0";
			}
			else if($mark>=26 && $mark <=29)
			{
				$band ="6.5";
			}
			else if($mark>=30 && $mark <=31)
			{
				$band ="7.0";
			}
			else if($mark>=32 && $mark <=34)
			{
				$band ="7.5";
			}
			else if($mark>=35 && $mark <=36)
			{
				$band ="8.0";
			}
			else if($mark>=37 && $mark <=38)
			{
				$band ="8.5";
			}
			else if($mark>=39 && $mark <=40)
			{
				$band ="9.0";
			}
			$ld['st_id'] = $st_id;
			$ld['ex_id'] = $ex_id;
			$ld['listening_score'] = $band;			
			$ld['listening_c_answer'] = $mark;			
			$this->WebRegistrationModel->insertUpdatedb('exam_student_mocktest_log',$ld,"listening_score='$band', listening_c_answer='$mark'");
			redirect("Exampanel/resultlistening?ex_id=$ex_id&submit=success", 'refresh');			
			
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function resultlistening()
	{
		$ex_id = $this->input->get('ex_id');
		$submit = $this->input->get('submit');
		
		$st_id = $this->session->userdata('st_id');		
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data))
		{	
			$mt = $this->WebRegistrationModel->getSingleData('*',"mt_id=".$exam_data->mt_id,'exam_mocktest');
			$sa = $this->WebRegistrationModel->getdataOrderBy('*',"elt_exam_id=$ex_id",'exam_student_listening_answer','elt_question_no');
			
			if(isset($submit))
			{
			    $data['no_result'] = 'true';
			}
			$data['log'] = $exam_data;
			$data['mt'] = $mt;
			$data['sa'] = $sa;
			$data['title'] = $mt->mt_name;
			$this->load->view('listening-result-details', $data);
				
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function listeninganswerpreview()
	{
		$ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');	
		
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data))
		{	
			$mt = $this->WebRegistrationModel->getSingleData('*',"lt_id=".$exam_data->mt_id,'exam_listening_test');
			$sa = $this->WebRegistrationModel->getdataOrderBy('*',"elt_exam_id=$ex_id",'exam_student_listening_answer','elt_question_no');
			
			$data['log'] = $exam_data;
			$data['ex_id'] = $ex_id;
			$data['canswer'] = $exam_data->listening_c_answer;
			$data['mt'] = $mt;
			$data['answer'] = $sa;
			$data['title'] = "IELTS Online Exam";
			$this->load->view('listening-result-preview', $data);
				
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	///----reading module
	public function readingmoduleinstruction()
	{
	    $ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');	
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{	
			$mt_name = $this->WebRegistrationModel->getSingleData('*',"mt_id='".$exam_data->mt_id."'",'exam_mocktest')->mt_name;
			$l_exam =  $this->WebRegistrationModel->getSingleData('*',"lt_id='".$exam_data->mt_id."'",'exam_listening_test');
			$data['ex_id'] = $ex_id;
			$data['mt_id'] = $exam_data->mt_id;
			$data['mt_name'] = $mt_name;
			$data['data'] = $l_exam;
			$id = $exam_data->mt_id;
			$this->load->view('reading-instruction', $data);
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	public function readingmodule()
	{		
		$ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');	
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{	
			$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id'",'exam_student_mocktest_log');		
			$mt_name = $this->WebRegistrationModel->getSingleData('*',"mt_id='".$exam_data->mt_id."'",'exam_mocktest')->mt_name;
			$r_exam =  $this->WebRegistrationModel->getSingleData('*',"rt_id='".$exam_data->mt_id."'",'exam_reading_test');
			$data['ex_id'] = $ex_id;
			$data['mt_id'] = $exam_data->mt_id;
			$data['mt_name'] = $mt_name;
			$data['data'] = $r_exam;
			$id = $exam_data->mt_id;
			$this->load->view('readingexam', $data);
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function submitreading()
	{
		$ex_id = $this->input->post('ex_id');		
		$mt_id = $this->input->post('mt_id');	
		$final_answer = $this->input->post('final_answer');	
		$st_id = $this->session->userdata('st_id');			
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"mt_id='$mt_id' AND ex_id='$ex_id' AND st_id='$st_id' AND is_completed='0'",'exam_student_mocktest_log');
		if(isset($exam_data))
		{			
			$c_answers = $this->WebRegistrationModel->getdataOrderBy('*',"rt_id='$mt_id'",'exam_reading_test_correct_answer','rt_sec_id,rt_q_no');
			$ans_count=0;
			$mark = 0;
			foreach ($c_answers as &$c_answer) 
			{
				$elt['ert_exam_id'] = $ex_id;
				$elt['ert_question_answer_c'] = $c_answer->rt_q_ans;
				$elt['ert_question_no'] = $ans_count+1;
				$elt['ert_answer'] = $final_answer[$ans_count];
				$elt['ert_if_correct'] = 0;
				$elt['create_date'] =  date('Y-m-d H:i:s');
				
				$cans = trim(strtoupper($c_answer->rt_q_ans));
				$uans = trim(strtoupper($final_answer[$ans_count]));				
				if (in_array($uans, explode("/",$cans)))
				{
					$mark++;
					$elt['ert_if_correct'] = 1;
				}
				
				$id =  $this->WebRegistrationModel->insertUpdatedb('exam_student_reading_answer',$elt,"ert_question_answer_c='".$c_answer->rt_q_ans."', ert_answer='".$final_answer[$ans_count]."', ert_if_correct='".$elt['ert_if_correct']."', create_date='".date('Y-m-d H:i:s')."'");
				
				$ans_count++;
			}
			$band = "0.0";
			if($mark>=4 && $mark <=5)
			{
				$band ="2.5";
			}
			else if($mark>=6 && $mark <=7)
			{
				$band ="3.0";
			}
			else if($mark>=10 && $mark <=8)
			{
				$band ="3.5";
			}
			else if($mark>=11 && $mark <=12)
			{
				$band ="4.0";
			}
			else if($mark>=13 && $mark <=15)
			{
				$band ="4.5";
			}
			else if($mark>=16 && $mark <=17)
			{
				$band ="5.0";
			}
			else if($mark>=18 && $mark <=22)
			{
				$band ="5.5";
			}
			else if($mark>=23 && $mark <=25)
			{
				$band ="6.0";
			}
			else if($mark>=26 && $mark <=29)
			{
				$band ="6.5";
			}
			else if($mark>=30 && $mark <=31)
			{
				$band ="7.0";
			}
			else if($mark>=32 && $mark <=34)
			{
				$band ="7.5";
			}
			else if($mark>=35 && $mark <=36)
			{
				$band ="8.0";
			}
			else if($mark>=37 && $mark <=38)
			{
				$band ="8.5";
			}
			else if($mark>=39 && $mark <=40)
			{
				$band ="9.0";
			}
			$ld['st_id'] = $st_id;
			$ld['ex_id'] = $ex_id;
			$ld['reading_score'] = $band;			
			$ld['reading_c_answer'] = $mark;			
			$this->WebRegistrationModel->insertUpdatedb('exam_student_mocktest_log',$ld,"reading_score='$band', reading_c_answer='$mark'");
			redirect("Exampanel/resultreading?ex_id=$ex_id&submit=success", 'refresh');			
			
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function resultreading()
	{
		$ex_id = $this->input->get('ex_id');
		$submit = $this->input->get('submit');
		$st_id = $this->session->userdata('st_id');	
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{		
			$mt = $this->WebRegistrationModel->getSingleData('*',"mt_id=".$exam_data->mt_id,'exam_mocktest');
			$sa = $this->WebRegistrationModel->getdataOrderBy('*',"ert_exam_id=$ex_id",'exam_student_reading_answer','ert_question_no');
			
			if(isset($submit))
			{
			    $data['no_result'] = 'true';
			}
			$data['log'] = $exam_data;
			$data['mt'] = $mt;
			$data['sa'] = $sa;
			$data['title'] = $mt->mt_name;
			$this->load->view('reading-result-details ', $data);
				
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function readinganswerpreview()
	{
		$ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');	
		
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data))
		{	
			$mt = $this->WebRegistrationModel->getSingleData('*',"rt_id=".$exam_data->mt_id,'exam_reading_test');
			$sa = $this->WebRegistrationModel->getdataOrderBy('*',"ert_exam_id=$ex_id",'exam_student_reading_answer','ert_question_no');
			
			$data['log'] = $exam_data;
			$data['ex_id'] = $ex_id;
			$data['canswer'] = $exam_data->reading_c_answer;
			$data['mt'] = $mt;
			$data['answers'] = $sa;
			$data['title'] = "IELTS Online Exam";
			$this->load->view('reading-result-preview', $data);
				
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	
	///----wrting module
	public function writingmodule()
	{		
		$ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');	
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{	
			$mt_name = $this->WebRegistrationModel->getSingleData('*',"mt_id='".$exam_data->mt_id."'",'exam_mocktest')->mt_name;
			$r_exam =  $this->WebRegistrationModel->getSingleData('*',"wt_id='".$exam_data->mt_id."'",'exam_writing_test');
			$data['ex_id'] = $ex_id;
			$data['mt_id'] = $exam_data->mt_id;
			$data['mt_name'] = $mt_name;
			$data['data'] = $r_exam;
			$id = $exam_data->mt_id;
			$this->load->view('writingexam', $data);
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function submitwriting()
	{
		$ex_id = $this->input->post('ex_id');		
		$mt_id = $this->input->post('mt_id');	
		$wrting_answer_1 = $this->input->post('answer_1');	
		$wrting_answer_2 = $this->input->post('answer_2');	
		$st_id = $this->session->userdata('st_id');			
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"mt_id='$mt_id' AND ex_id='$ex_id' AND st_id='$st_id' AND is_completed='0'",'exam_student_mocktest_log');
		if(isset($exam_data))
		{		
		
			$ld['ex_id']=$ex_id;
			$ld['wrting_answer_1']=$wrting_answer_1;
			$ld['wrting_answer_2']=$wrting_answer_2;
			$ld['writing_score']='-1';
			$this->WebRegistrationModel->insertUpdatedb('exam_student_mocktest_log',$ld,"wrting_answer_1='$wrting_answer_1', wrting_answer_2='$wrting_answer_2',writing_score='-1'");
			redirect("Exampanel/resultwriting?ex_id=$ex_id", 'refresh');			
			
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	public function resultwriting()
	{
		$ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');	
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{		
			$mt = $this->WebRegistrationModel->getSingleData('*',"mt_id=".$exam_data->mt_id,'exam_mocktest');			
			
			$data['log'] = $exam_data;
			$data['mt'] = $mt;
			$data['title'] = $mt->mt_name;
			$this->load->view('writing-result-details', $data);
				
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function writinganswerpreview()
	{
		$ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');	
		
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{	
			$mt = $this->WebRegistrationModel->getSingleData('*',"wt_id=".$exam_data->mt_id,'exam_writing_test');			
			
			$data['log'] = $exam_data;
			$data['ex_id'] = $ex_id;
			$data['canswer'] = $exam_data->reading_c_answer;
			$data['mt'] = $mt;
			$data['title'] = "IELTS Online Exam";
			$this->load->view('writing-result-preview', $data);
				
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function speakingmodule()
	{		
		$ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');		
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{
			$part = $this->input->get('part');	
			if(!isset($part))
			{
				$part = "1";
			}
			$mt_name = $this->WebRegistrationModel->getSingleData('*',"mt_id='".$exam_data->mt_id."'",'exam_mocktest')->mt_name;
			$s_exam =  $this->WebRegistrationModel->getSingleData('*',"st_id='".$exam_data->mt_id."'",'exam_speaking_test');
			$data['ex_id'] = $ex_id;			
			$data['mt_id'] = $exam_data->mt_id;
			$data['exam_data'] = $exam_data;
			$data['mt_name'] = $mt_name;
			$data['data'] = $s_exam;
			$data['part'] = $part;
			$this->load->view('speakingexam', $data);
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function uploadrecordedaudio()
	{
		$ex_id = $this->input->get('ex_id');		
		$mt_id = $this->input->get('mt_id');	
		$part = $this->input->get('part');	
		$st_id = $this->session->userdata('st_id');	
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"mt_id='$mt_id' AND ex_id='$ex_id' AND st_id='$st_id' AND is_completed='0'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{		
				$data['log'] = $exam_data;
				$data['mt_id'] = $mt_id;
				$data['ex_id'] = $ex_id;
				$data['part'] = $part;
    			$this->load->view('upload-audio', $data);
		}
		else
		{
		    	redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function submituploadrecordedaudio()
	{
		$ex_id = $this->input->post('ex_id');		
		$mt_id = $this->input->post('mt_id');	
		$part = $this->input->post('part');	
		$file = $this->input->post('file');	
		$st_id = $this->session->userdata('st_id');	
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"mt_id='$mt_id' AND ex_id='$ex_id' AND st_id='$st_id' AND is_completed='0'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{		
				$file_name = $file;
        	    $this->load->helper(array('form', 'url','string')); 
        	    
                $config['upload_path']   = './uploads/'; 
                $config['allowed_types'] = 'mp3';  
                
                $new_name = time().random_string('alnum', 16);
                $config['file_name'] = $new_name;
                
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('file')) {
                    $error = array('error' => $this->upload->display_errors()); 
                    echo $error['error'];
                }
                
                else 
        		{ 
        		    $new_name = base_url()."uploads/".$new_name.".mp3";
                    if($part=='1')
        			{
        				$ut = "speaking_answer_1='$new_name'";
        				$utn = 'speaking_answer_1';
        			}
        			else if($part=='2')
        			{
        				$ut = "speaking_answer_2='$new_name'";
        				$utn = 'speaking_answer_2';
        			}
        			else if($part=='3')
        			{
        				$ut = "speaking_answer_3='$new_name'";
        				$utn = 'speaking_answer_3';
        			}
        			$ld['ex_id']=$ex_id;
        			$ld[$utn]=$new_name;
        			$this->WebRegistrationModel->insertUpdatedb('exam_student_mocktest_log',$ld,$ut);				
        			echo "<script>
        					var p = window.self;
        					p.opener = window.self;
        					p.close();
        				  </script>";
                } 
		}
		else
		{
		    	redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	
	public function submitrecordedaudio()
	{
		$ex_id = $this->input->post('ex_id');		
		$mt_id = $this->input->post('mt_id');	
		$part = $this->input->post('part');	
		$file_name = base_url().$this->input->post('file_name');	
		$st_id = $this->session->userdata('st_id');			
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"mt_id='$mt_id' AND ex_id='$ex_id' AND st_id='$st_id' AND is_completed='0'",'exam_student_mocktest_log');
		if(isset($exam_data))
		{		
			if($part=='1')
			{
				$ut = "speaking_answer_1='$file_name'";
				$utn = 'speaking_answer_1';
			}
			else if($part=='2')
			{
				$ut = "speaking_answer_2='$file_name'";
				$utn = 'speaking_answer_2';
			}
			else if($part=='3')
			{
				$ut = "speaking_answer_3='$file_name'";
				$utn = 'speaking_answer_3';
			}
			$ld['ex_id']=$ex_id;
			$ld[$utn]=$file_name;
			$this->WebRegistrationModel->insertUpdatedb('exam_student_mocktest_log',$ld,$ut);				
			echo "<script>
					var p = window.self;
					p.opener = window.self;
					p.close();
				  </script>";
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function getrecordedaudio()
	{
		$ex_id = $this->input->get('ex_id');	
		$mt_id = $this->input->get('mt_id');	
		$part = $this->input->get('part');		
		$st_id = $this->session->userdata('st_id');			
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"mt_id='$mt_id' AND ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data))
		{			
			for ($x = 0; $x <= 50; $x++)
			{
				$data="";	
				if($part=='1')
				{
					$data=$exam_data->speaking_answer_1;
				}
				else if($part=='2')
				{
					$data=$exam_data->speaking_answer_2;
				}
				else if($part=='3')
				{
					$data=$exam_data->speaking_answer_3;
				}
				if($data=="")
				{
					$exam_data = $this->WebRegistrationModel->getSingleData('*',"mt_id='$mt_id' AND ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
				}
				else{
					echo $data;
					break;
				}
				sleep(1);
			}
							
		}
	}
	public function submitspeaking()
	{
		$ex_id = $this->input->post('ex_id');		
		$mt_id = $this->input->post('mt_id');		
		$st_id = $this->session->userdata('st_id');			
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"mt_id='$mt_id' AND ex_id='$ex_id' AND st_id='$st_id' AND is_completed='0'",'exam_student_mocktest_log');
		if(isset($exam_data))
		{		
		
			$ld['ex_id']=$ex_id;
			$ld['speaking_score']='-1';
			$this->WebRegistrationModel->insertUpdatedb('exam_student_mocktest_log',$ld,"speaking_score='-1'");
			redirect("Exampanel/resultspeaking?ex_id=$ex_id", 'refresh');			
			
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function resultspeaking()
	{
		$ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');	
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{		
			$mt = $this->WebRegistrationModel->getSingleData('*',"mt_id=".$exam_data->mt_id,'exam_mocktest');			
			
			$data['log'] = $exam_data;
			$data['mt'] = $mt;
			$data['title'] = $mt->mt_name;
			$this->load->view('speaking-result-details', $data);
				
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function speakinganswerpreview()
	{
		$ex_id = $this->input->get('ex_id');
		$st_id = $this->session->userdata('st_id');	
		
		$exam_data = $this->WebRegistrationModel->getSingleData('*',"ex_id='$ex_id' AND st_id='$st_id'",'exam_student_mocktest_log');
		if(isset($exam_data->ex_id))
		{	
			$mt = $this->WebRegistrationModel->getSingleData('*',"st_id=".$exam_data->mt_id,'exam_speaking_test');			
			
			$data['log'] = $exam_data;
			$data['ex_id'] = $ex_id;
			$data['mt'] = $mt;
			$data['title'] = "IELTS Online Exam";
			$this->load->view('speaking-result-preview', $data);
				
		}
		else
		{
			redirect("Exampanel/rederror", 'refresh');
		}
	}
	
	public function studentmocklist()
	{
	    $id = $this->input->get('id');
	    $st_id = $this->session->userdata('st_id');
	    $data = array();
        $data['title']='Dashboard';      
        $data['subtitle']='Control panel';
        $data['page_name']= "student-mocktest-list";
        $st_id = $this->session->userdata('st_id');
        $data['data']= $this->WebRegistrationModel->getdata('*'," package_id=$id and package_id in (select ID from wpao_posts where post_type='lp_course' and post_status='publish' and ID in (SELECT item_id FROM wpao_learnpress_user_items WHERE user_id = $st_id))",'exam_pac_mock');
        
        //print_r($this->session->userdata());
        $this->load->view('student-dashboard',$data);
	}
	public function studentmocktesthistpry()
	{
	    $id = $this->input->get('id');
	    $st_id = $this->session->userdata('st_id');
	    $data = array();
        $data['title']='Dashboard';      
        $data['subtitle']='Control panel';
        $data['page_name']= "student-mocktest-result-list";
        $st_id = $this->session->userdata('st_id');
        $data['data']= $this->WebRegistrationModel->getdata('*',"st_id=$st_id and is_completed=1",'exam_mock_test_record');
        
        //print_r($this->session->userdata());
        $this->load->view('student-dashboard',$data);
	}
	
}