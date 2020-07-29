<?php

/**
 * 
 */
class Home extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Store');
        date_default_timezone_set("Asia/Kolkata");
	}

	public function index()
	{
		$data['category']=$this->Store->getcategories();
 		$this->load->view('home',$data);
//        $this->load->view('maintenance');
	}

	public function category($id,$name)
	{
		$data['title']=$name;
		$data['subcategory']=$this->Store->loadsubcategories($id);
		$this->load->view('category',$data);
	}

	public function subcategory($id,$name)
	{
		$data['title']=$name;
		$data['topic']=$this->Store->loadtopic($id);
		$this->load->view('topic',$data);
	}

	public function loadbooks($id,$subno,$name)
	{
		$data['title']=$name;
		$data['books']=$this->Store->loadbooks($id,$subno);
		$this->load->view('books',$data);
	}

	public function showbook($id)
	{
		$data['book']=$this->Store->loadbook($id);
        $data['title']='';
		$this->load->view('bookdetail',$data);
	}

	public function cart()
	{
	    //initialize cart
        $data['title'] = 'Cart';
		$this->load->database();

		//inserting an item to cart
		if (isset($_POST['id']))
		{
            $id=$_POST['id'];
            //create a session if no book has been added
            if (!isset($_SESSION['cart']))
            {
                $_SESSION['cart']=array();
                $_SESSION['cart'][]=$id;
            }
            else
            {
                $tag=1;
                foreach ($_SESSION['cart'] as $key => $value) {
                    //if a book is already added
                    if ($value==$id) {
                        $tag=1;
                    }
                    else
                    {
                        $tag=0;
                    }
                }
                // if a book is not yet added
                if ($tag!=1) {
                    $_SESSION['cart'][]=$id;
                }
            }
        }

		//deleting an item from cart
        if (isset($_POST['delid']) && isset($_SESSION['cart'])) {
            $delid=$_POST['delid'];
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value==$delid) {
                    unset($_SESSION['cart'][$key]);
                    unset($_SESSION['cost'][$delid]);
                    if (isset($_SESSION['final_cart'])) {
                        unset($_SESSION['final_cart'][$key]);
                    }
                }
            }
        }

        if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }

        //creating a final list of items
        if (isset($_SESSION['cart'])){
            $_SESSION['final_cart'] = $_SESSION['cart'];
        }

        //add cost to cart
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                $sql = "SELECT * FROM books WHERE id=?";
                $query = $this->db->query($sql, $value);
                $result = $query->result();
                foreach ($result as $row) {
                    $_SESSION['cost'][$value] = ceil($row->MRP - $row->Discount / 100 * $row->MRP + $row->charges);
                    //check if a book is out of stock
                    if (!$row->availability) {
                        unset($_SESSION['cost'][$value]);
                        unset($_SESSION['final_cart'][$key]);
                    }
                }
            }
        }

        //calculate total items
        $count=0;
        if (isset($_SESSION['final_cart'])) {
            foreach ($_SESSION['final_cart'] as $key => $value) {
            $count++;
            }
        }

        //calculate the total amount
        $total=0;
        if (isset($_SESSION['cost'])) {
            foreach ($_SESSION['cost'] as $key => $value) {
                $total=$total+$value;
            }
        }


        $data['total'] = $total;
        $data['count']=$count;
		$this->load->view('cart',$data);
	}

	public function search()
	{
        $this->load->database();
        $output = '';
        if(isset($_POST["query"])) {
             $search = $_POST['query'];
             $query = "
              SELECT * FROM books 
              WHERE title LIKE '%".$search."%'
              OR Publisher LIKE '%".$search."%' 
              OR Author LIKE '%".$search."%' 
             ";
        } else {
             $query = "
              SELECT * FROM books ORDER BY title asc
             ";
        }

        $sql=$this->db->query($query);
        $result = $sql->result();

        if($result!=NULL) {
            foreach($result as $row) {
                  echo '
                    <div class="col-xs-6" style="margin-top: 20px;">
                    <a href="'.site_url('home/showbook/').$row->id.'">
                    <img src="'.base_url('assets/thumbnails/').$row->image.'" class="book-image">
                    <p class="book-title">'.$row->title.'</p></a>
                    </div>
                  ';
            }
        } else {
             echo '<p style="font-family: RedhatR; font-size: 18px;">Not Found.</p>';
        }
	}


	public function listcategories()
	{
	    $data['title'] = 'SHOP BY CATEGORY';
		$data['category']=$this->Store->getcategories();
		$this->load->view('categorylist',$data);
	}

	public function examcentral()
	{
        $data['title'] = 'EXAM CENTRAL';
		$this->load->view('examcentral',$data);
	}


	public function privacy()
	{
		$this->load->view('privacy.php');
	}

	public function terms()
	{
		$this->load->view('terms.php');
	}

	public function placeorder()
	{
	    $this->load->model('Account');
	    $data['title'] = "Enter Your Details";
        if (!isset($_SESSION['cart'])) {
            redirect(site_url('home'));
        }
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['confirm_user'] = TRUE;
            redirect(site_url('home/signin'));
        }

        $userId = $_SESSION['user_id'];
        $data['user'] = $this->Account->details($userId);
        $data['amount'] = $_SESSION['amount'];
            $this->load->view('placeorder',$data);
	}

	public function payment(){
	    $amount = $_SESSION['amount'];
        \Stripe\Stripe::setApiKey('sk_test_51H3hLRE7tUzyZRD9bnguSMUNiPQ8rbEJy3OTdgem4Hs892xkH3N1IfTzqCWyLfpVIbluIgrSSnhb7840obP0uEyy003JnvFmLD');
        $intent = \Stripe\PaymentIntent::create([
            'amount' => intval($amount),
            'currency' => 'inr',
            // Verify your integration in this guide by including this parameter
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);
        $data['intent'] = $intent;
        if (!isset($_SESSION['cart'])) {
            redirect(site_url('home'));
        }

        $details = array(
            'user_id' => $_SESSION['user_id'],
            'Name' => $this->input->post('name'),
            'Contact' => $this->input->post('contact'),
            'Email' => $this->input->post('email'),
            'Address' => $this->input->post('address'),
            'Items' => json_encode($_SESSION['final_cart']),
            'Total' => $_SESSION['amount'],
            'intent_id' => $intent->id,
            'Status' => $intent->status,
            'shipping_status' => 'Order Received'
        );
        $_SESSION['order_id'] = $intent->id;
        $this->Store->addOrder($details);
        $this->load->view('checkout',$data);
    }

	public function thanks()
	{
	if (!isset($_SESSION['cart'])) {
        redirect(site_url('home'));
	}
		$this->load->view('user');
	}

	public function contact()
	{
	    $data['title'] = 'Contact Us';
		$this->load->view('contact',$data);
	}

	public function signIn(){
	    if (isset($_SESSION['user_id'])) {
	        redirect(site_url('user'));
        } else {
            $this->load->view('auth/signin');
        }
    }

    public function register(){
	    $this->load->view('auth/register');
    }
}
?>