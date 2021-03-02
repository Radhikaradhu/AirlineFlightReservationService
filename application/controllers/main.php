  
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('index');
	}
	
    //new

	 public function register()
    {
        $this->load->view('index');
    }
     public function gallery()
    {
        $this->load->view('gallery');
    }
    public function service()
    {
        $this->load->view('service');
    }
    public function contact()
    {
        $this->load->view('contact');
    }
    public function user()
    {
        $this->load->view('user');
    }
    //Insert register details
	public function reg()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("fname","fname",'required');
        $this->form_validation->set_rules("lname","lname",'required');
        $this->form_validation->set_rules("age","age",'required');
        $this->form_validation->set_rules("gender","gender",'required');
        $this->form_validation->set_rules("address","address",'required');
        $this->form_validation->set_rules("phno","phno",'required');
        $this->form_validation->set_rules("adno","adno",'required');
        $this->form_validation->set_rules("email","email",'required');
        $this->form_validation->set_rules("password","password",'required');
        if($this->form_validation->run())
        {
        $this->load->model('mainmodel');
        $pass=$this->input->post("password");
        $encpass=$this->mainmodel->encpswd($pass);
        $a=array("fname"=>$this->input->post("fname"),
                "lname"=>$this->input->post("lname"),
                "age"=>$this->input->post("age"),
                 "gender"=>$this->input->post("gender"),
                  "address"=>$this->input->post("address"),
                "phno"=>$this->input->post("phno"),"adno"=>$this->input->post("adno"));
       $b=array("email"=>$this->input->post("email"),
                "password"=>$encpass,
                "utype"=>'0');
        $this->mainmodel->inreg($a,$b);    
        redirect(base_url().'main/index'); 
        }
    }    

     // Login 
   public function loginform()
    {
        $this->load->view('logform');
    }
     public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("email","email",'required');
        $this->form_validation->set_rules("password","password",'required');
            if($this->form_validation->run())
            {
                $this->load->model('mainmodel');
                $email=$this->input->post("email");
                $pass=$this->input->post("password");
                $rslt=$this->mainmodel->select($email,$pass);
                if($rslt)
                {
                    $id=$this->mainmodel->getuserid($email);
                    $user=$this->mainmodel->getuser($id);
                 $this->load->library(array('session'));
                $this->session->set_userdata(array('id'=>(int)$user->id,'status'=>$user->status,'utype'=>$user->utype));
                    if($_SESSION['utype']=='1' )
                    {
                                redirect(base_url().'main/admin');
                    }
                    elseif($_SESSION['utype']=='0' )
                    {
                                redirect(base_url().'main/user');
                    }
                    else
                    {
                        echo "waiting for approval";
                    }
                }
                else
                {
                 echo "invalid user";
                }
            }
else{
    redirect('main/logform','refresh');
    }
}

     // View User Details
     public function view()
    {
        $this->load->model('mainmodel');
        $data['n']=$this->mainmodel->view();
        $this->load->view('view',$data);
    }   

    //  // Approve the user
    // public function approve()
    // {
    //     $this->load->model('mainmodel');
        
    //     $id=$this->uri->segment(3);
    //     $this->mainmodel->approve($id);
    //     redirect('main/view','refresh');
    // }   

    // //Reject the user 
    // public function reject()
    // {
    //     $this->load->model('mainmodel');
        
    //     $id=$this->uri->segment(3);
    //     $this->mainmodel->reject($id);
    //     redirect('main/view','refresh');
    // }

    //Admin View Dashboard
    public function admin()
	{
		$this->load->view('admin');
	}

	//View Page of Airport Details
	public function airportdet()
	{
		$this->load->view('airport_det');
	} 

	//Insert Airport Details
	public function airportinsert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("aname","aname",'required');
		$this->form_validation->set_rules("cntry","cntry",'required');
		$this->form_validation->set_rules("state","state",'required');
		$this->form_validation->set_rules("contact","contact",'required');
		$this->form_validation->set_rules("loc","loc",'required');
		if($this->form_validation->run())
		{
		$this->load->model('mainmodel');
		$a=array("aname"=>$this->input->post("aname"),"cntry"=>$this->input->post("cntry"),"state"=>$this->input->post("state"),"contact"=>$this->input->post("contact"),"loc"=>$this->input->post("loc"));
		$this->mainmodel->airportmodel($a);
		redirect(base_url().'main/admin');

		}

	}

	//flight details Form
    public function search()
    {
        $this->load->model('mainmodel');
        $state=$this->input->post("state");
        $data['user_data']=$this->mainmodel->search($state);
        $this->load->view('booking',$data);
    }

public function regusertable()
    {
        $this->load->model('mainmodel');
        $data['n']=$this->mainmodel->reguser1();
        $this->load->view('reguserview',$data);

    }
public function regupdate()
    {
       
        $this->load->model('mainmodel');
        $id=$this->session->id;
        $data['user_data']=$this->mainmodel->regupdateform($id);
        $this->load->view('userupdate',$data);

    }
    //profile update
    public function reguserupdate()
    {
        $a=array("fname"=>$this->input->post("fname"),"lname"=>$this->input->post("lname"),"age"=>$this->input->post("age"),"gender"=>$this->input->post("gender"),"address"=>$this->input->post("address"),"phno"=>$this->input->post("phno"),"adno"=>$this->input->post("adno"));
        $b=array("email"=>$this->input->post("email"));
        $this->load->model('mainmodel');
       
        if($this->input->post("update"))
        {
            $id=$this->session->id;
            $this->mainmodel->regupdateform1($a,$b,$id);
            redirect('main/regupdate','refresh');
        }

    }
public function airportdetails()
    {
        $this->load->model('mainmodel');
        $data['n']=$this->mainmodel->airportdetails1();
        $this->load->view('airportview',$data);

    }
    //airport deletion
    public function deleteairport()
    {  
    $this->load->model('mainmodel');
    $id=$this->uri->segment(3);
    $this->mainmodel->deleteairport($id);
    redirect('main/airportdetails','refresh');
}
    //airport updation
public function airportupdateview()
    {
       
        $this->load->model('mainmodel');
        $id=$this->uri->segment(3);
        //$id=$this->session->id;
        $data['user_data']=$this->mainmodel->airportupdateform($id);
        $this->load->view('airportupdate',$data);

    }
    public function airportupdate1()
    {
        $this->load->model('mainmodel');
        $a=array("aname"=>$this->input->post("aname"),
            "cntry"=>$this->input->post("cntry"),
            "state"=>$this->input->post("state"),
            "contact"=>$this->input->post("contact"),
            "loc"=>$this->input->post("loc"));
       
       
        if($this->input->post("update"))
        {
           // $id=$this->session->id;
            //$id=$this->uri->segment(3);
            $id=$this->input->post("id");
            $this->mainmodel->airportupdateform1($a,$id);
            redirect('main/airportdetails','refresh');
        }

    }

    //Kripa Babu
    //flight details Form
public function flightdetails()
    {
        $this->load->view('flightdetail');
    } 

    //action for details insertion
public function addfdetails()
{
    $this->load->library('form_validation');
        $this->form_validation->set_rules("fno","flight number",'required');
        $this->form_validation->set_rules("fname","flight name",'required');
        $this->form_validation->set_rules("departure","departure",'required');
        $this->form_validation->set_rules("arrival","arrival",'required');
        $this->form_validation->set_rules("depdate","departure date",'required');
        $this->form_validation->set_rules("ardate","arrival date",'required');
        $this->form_validation->set_rules("deptime","departure time",'required');
        $this->form_validation->set_rules("artime","arrival time",'required');
        $this->form_validation->set_rules("costfirst","ticket charge",'required');
         $this->form_validation->set_rules("costeconomic","ticket charge",'required');
          $this->form_validation->set_rules("costbuisness","ticket charge",'required');
        $this->form_validation->set_rules("cfirst","first class seatcapacity",'required');
        $this->form_validation->set_rules("ceconomic","economic class seatcapacity",'required');
        $this->form_validation->set_rules("cbuisness","buisness class seatcapacity",'required');

         $this->form_validation->set_rules("afirst","first class seatAvailability",'required');
        $this->form_validation->set_rules("aeconomic","economic class seatAvailability",'required');
        $this->form_validation->set_rules("abuisness","buisness class seatAvailability",'required');
        if($this->form_validation->run())
        {
        $this->load->model('mainmodel');
        $pass=$this->input->post("password");
        $encpass=$this->mainmodel->encpswd($pass);
        $a=array("fno"=>$this->input->post("fno"),
                "fname"=>$this->input->post("fname"),
                "departure"=>$this->input->post("departure"),
                 "arrival"=>$this->input->post("arrival"),
                  "depdate"=>$this->input->post("depdate"),
                "arrdate"=>$this->input->post("ardate"),
                "deptime"=>$this->input->post("deptime"),
                "arrtime"=>$this->input->post("artime"),
                "costfirst"=>$this->input->post("costfirst"),
                "costeconomic"=>$this->input->post("costeconomic"),
                "costbuisness"=>$this->input->post("costbuisness"),
                "cfirst"=>$this->input->post("cfirst"),
                 "ceconomic"=>$this->input->post("ceconomic"),
                  "cbuisness"=>$this->input->post("cbuisness"),
                "afirst"=>$this->input->post("afirst"),
                 "aeconomic"=>$this->input->post("aeconomic"),
                  "abuisness"=>$this->input->post("abuisness"),);
       
        $this->mainmodel->flightdetails($a);    
        redirect(base_url().'main/flightdetails'); 
        }
    } 

    //view flight details by admin

    public function viewflightdetails()
    { 
        $this->load->model('mainmodel');
        $d=date('y-m-d');
        $this->mainmodel->deletedate($d);
        $data['n']=$this->mainmodel->aviewflight();

        $this->load->view('fdetailsviewad',$data);
    }
    //update notification by admin


    //view details for updation
    public function viewflight()
    {
        $this->load->model('mainmodel');
        $id=$this->uri->segment(3);
        $data['user_data']=$this->mainmodel->viewflight($id);
        $this->load->view('updateflight',$data);

    }

    //updation action
    public function updateflight()

    {

        $this->load->model('mainmodel');

        
        // $data['user_data']=$this->mainmodel->viewflight($id);
        // $this->load->view('updateflight',$data);

        $a=array("fno"=>$this->input->post("fno"),
                "fname"=>$this->input->post("fname"),
                "departure"=>$this->input->post("departure"),
                 "arrival"=>$this->input->post("arrival"),
                  "depdate"=>$this->input->post("depdate"),
                "arrdate"=>$this->input->post("ardate"),
                "deptime"=>$this->input->post("deptime"),
                "arrtime"=>$this->input->post("artime"),
                "costfirst"=>$this->input->post("costfirst"),
                "costeconomic"=>$this->input->post("costeconomic"),
                "costbuisness"=>$this->input->post("costbuisness"),
                "cfirst"=>$this->input->post("cfirst"),
                 "ceconomic"=>$this->input->post("ceconomic"),
                  "cbuisness"=>$this->input->post("cbuisness"),
                "afirst"=>$this->input->post("afirst"),
                 "aeconomic"=>$this->input->post("aeconomic"),
                  "abuisness"=>$this->input->post("abuisness"));
        
if($this->input->post("submit"))
{
    $id=$this->input->post("id");
$this->mainmodel->updateflight($a,$id);
redirect(base_url().'main/viewflightdetails'); 

}
}

//delete flight details by admin

public function deleteflight()
{

$this->load->model('mainmodel');
$id=$this->uri->segment(3);
$this->mainmodel->deleteflight($id);
redirect('main/viewflightdetails','refresh');
}


    //add notification by admin
    public function notificationadd()
    {
        $this->load->model('mainmodel');
        $data['n']=$this->mainmodel->dataselect();
        $this->load->view('adminnotification',$data);  //loading view

    }

    //action for insertion of notification

    public function notify_action()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("notification","notification",'required')
        ;

        if($this->form_validation->run())
        {

            
            $this->load->model('mainmodel');
            $d=date('y-m-d');
            $n=array("notification"=>$this->input->post("notification"),"cdate"=>$d,"fid"=>$this->input->post("fno"));

            $this->mainmodel->notification($n);
            redirect('main/notificationadd','refresh');
        }   
    }   


//Search flight by user 
    public function searchflight()
    {
        $this->load->view('searchform');
    } 
    public function searchaction()
    {
        $this->load->model('mainmodel');
        $d=date('y-m-d');
        $this->mainmodel->deletedate($d);
        $dep=$this->input->post("departure");
        $arr=$this->input->post("arrival");
        $depdate=$this->input->post("depdate");
        $data['n']=$this->mainmodel->uviewflight($dep,$arr,$depdate);
        $this->load->view('fdetailsviewus',$data);

    }

    //flight booking

    public function bookflight()
    {

        $this->load->model('mainmodel');
        $sid=$this->session->id;
        $id=$this->uri->segment(3);
        // $newdata=array('id'=>$id);
        // $this->session->set_userdata($newdata);
        $data['user_data']=$this->mainmodel->bookflightdetails($id);
        $data['user_dat']=$this->mainmodel->bookuserdetails($sid);
        //$this->load->view('bookflight',$dat);
        $this->load->view('bookflight',$data);
    }


//booking action
    public function bookingaction()
    {
        $this->load->model('mainmodel');

        $sid=$this->session->id;
        $fid=$this->input->post("id");
        $class=$this->input->post("clas");
        $age=$this->input->post("age");
        $cfirst=$this->input->post("costfirst");
        $ceconomic=$this->input->post("costeconomic");
        $cbuisness=$this->input->post("costbuisness");
        $cost=0;
        if($age>60 && $class=="First class")
        {
            $cost=$cfirst-500;
             $a=array("class"=>$class,"ticketcharge"=>$cost,
                 "flightid"=>$fid,"userid"=>$sid);
            $this->mainmodel->bookinginsert($a);
            $this->mainmodel->updatefirst($fid);
        }
        elseif($age>60 && $class=="Economic class")
        {
            $cost=$ceconomic-500;
             $a=array("class"=>$class,"ticketcharge"=>$cost,
                 "flightid"=>$fid,"userid"=>$sid);
            $this->mainmodel->bookinginsert($a);
            $this->mainmodel->updateeconomic($fid);

        }

        elseif($age>60 && $class=="Buisness class")
        {
            $cost=$cbuisness-500;
             $a=array("class"=>$class,"ticketcharge"=>$cost,
                 "flightid"=>$fid,"userid"=>$sid);
            $this->mainmodel->bookinginsert($a);
            $this->mainmodel->updatebuisness($fid);
        }

        elseif($age<60 && $class=="First class")
        {

             $a=array("class"=>$class,"ticketcharge"=>$cfirst,
                 "flightid"=>$fid,"userid"=>$sid);
            $this->mainmodel->bookinginsert($a);
            $this->mainmodel->updatebuisness($fid);
        }
         elseif($age<60 && $class=="Economic class")
        {

             $a=array("class"=>$class,"ticketcharge"=>$ceconomic,
                 "flightid"=>$fid,"userid"=>$sid);
            $this->mainmodel->bookinginsert($a);
            $this->mainmodel->updateeconomic($fid);
        }
         else
        {

             $a=array("class"=>$class,"ticketcharge"=>$cbuisness,
                 "flightid"=>$fid,"userid"=>$sid);
            $this->mainmodel->bookinginsert($a);
            $this->mainmodel->updatebuisness($fid);
        }

       

redirect(base_url().'main/payment'); 

}
//payment

public function payment()
    {
        $this->load->view('payment');
    }
//main
public function ticket()
    {
        $this->load->view('ticket');
    }

    
public function pay()
    {
       // $this->load->view('success');
        echo "success";
    }

//view booking by admin
public function viewbooking()
    {
        
        $this->load->model('mainmodel');
        $data['n']=$this->mainmodel->viewbooking();
        $this->load->view('bookingview',$data);

    }

    //view booking by user
public function viewbookinguser()
    {
        $sid=$this->session->id;
        $this->load->model('mainmodel');
        $data['n']=$this->mainmodel->viewbookinguser($sid);
        $this->load->view('bookingviewuser',$data);

    }
    //view notification by user
    public function viewnotif()
    {
        
        $this->load->model('mainmodel');
        $data['n']=$this->mainmodel->viewnotif();
        $this->load->view('notificationview',$data);

    }

    //flight cancel by admin
    public function cancelflight()
    {
            $this->load->model('mainmodel');
            $id=$this->uri->segment(3);
            $d=date('y-m-d');
            $notification="This Flight is cancelled, payement will refund after 12 day";
            $n=array("notification"=>$notification,"cdate"=>$d,"fid"=>$id);

            $this->mainmodel->notification($n);
            $this->mainmodel->statusupdate($id);
            redirect('main/viewflightdetails','refresh');
    }
     //view notification
    public function notifview1()
    {
        $this->load->model('Mainmodel');
        $data['n']=$this->Mainmodel->notifview2();
        $this->load->view('notifview',$data);

        

    }
    //delete notification
    public function deletenotif()
    {  
    $this->load->model('mainmodel');
    $id=$this->uri->segment(3);
    $this->mainmodel->deletenotif($id);
    redirect('main/notifview1','refresh');
}

 public function searchflightin()
    {
        $this->load->view('searchformin');
    } 
    public function searchactionin()
    {
        $this->load->model('mainmodel');
        $d=date('y-m-d');
        $this->mainmodel->deletedate($d);
        $dep=$this->input->post("departure");
        $arr=$this->input->post("arrival");
        $depdate=$this->input->post("depdate");
        $data['n']=$this->mainmodel->uviewflight($dep,$arr,$depdate);
        $this->load->view('fdetailsviewin',$data);

    }

   
}
	

	
