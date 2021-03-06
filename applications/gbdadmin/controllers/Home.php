<?php 

/**
 * 
 */
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Store');
		session_start();
		if (!isset($_SESSION['id'])){
			redirect(site_url('login'));
		}
	}

	function index()
	{
		$this->load->view('home');
	}

	function orders()
	{
		$data['orders']=$this->Store->fetchorders();
		$this->load->view('orders',$data);
	}

	function generateinvoice($id)
	{
		$this->load->database();
		$data['data']=$this->Store->fetchinvoicedata($id);
		$this->load->view('invoice',$data);
	}

	function inventory()
	{
		$data['books']=$this->Store->getbooks();
		$this->load->view('inventory',$data);
	}
	function addbook()
	{
		$data['category']=$this->Store->getcategories();
		$this->load->database();
		$this->load->view('addbook',$data);
	}

	function selection()
	{
		$this->load->database();
		if (isset($_POST['id']) && !empty($_POST['id'])) {
 		$sql="SELECT * FROM booksubsub WHERE subno=?";
 		$query=$this->db->query($sql,$_POST['id']);
 		$result=$query->result();
 		echo "<option value=''>Select Course </option>";
 		foreach($result as $row) {
 			echo '<option value="'.$row->id.'">'.$row->name.'</option>';
 	}
 }
 	

if (isset($_POST['subid']) && !empty($_POST['subid'])) {
 	$sql="SELECT * FROM subject WHERE subno=?";
 	$query=$this->db->query($sql,($_POST['subid']));
 	$result=$query->result();
 	
 	foreach($result as $row) {
 			echo '<option value="'.$row->id.'">'.$row->name.'</option>';
 	}
 	

 }
	}


	function insertbook()
	{

				$config['upload_path']          = './assets/images/';
                $config['allowed_types']        = 'gif|jpeg|png|jpg|bmp';
                $config['max_size']             = 20000;
                $config['max_width']            = 10000;
                $config['max_height']           = 10000;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('cover'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $img=NULL;
                        print_r($error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                      $img=$data['upload_data']['file_name'];
                $config1['image_library'] = 'gd2';
                $config1['source_image'] = './assets/images/'.$img;
                $config1['new_image'] = './assets/thumbnails/';
                $config1['create_thumb'] = TRUE;
                $config1['maintain_ratio'] = TRUE;
                $config1['thumb_marker']='';
                $config1['width']         = 300;
                $config1['height']       = 600;

				$this->load->library('image_lib', $config1);

				$this->image_lib->resize();
				unset($this->upload);
				unset($this->image_lib);
                 }


                 $config['upload_path']          = './assets/images/';
                $config['allowed_types']        = 'gif|jpeg|png|jpg|bmp';
                $config['max_size']             = 20000;
                $config['max_width']            = 10000;
                $config['max_height']           = 10000;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('backcover'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $backimg=NULL;
                        print_r($error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                      $backimg=$data['upload_data']['file_name'];
                $config1['image_library'] = 'gd2';
                $config1['source_image'] = './assets/images/'.$backimg;
                $config1['new_image'] = './assets/thumbnails/';
                $config1['create_thumb'] = TRUE;
                $config1['maintain_ratio'] = TRUE;
                $config1['thumb_marker']='';
                $config1['width']         = 500;
                $config1['height']       = 800;

				$this->load->library('image_lib', $config1);

				$this->image_lib->resize();
				unset($this->upload);
				unset($this->image_lib);
                 }

                      $data=array(
                	'catno'=> $_POST['subcat'],
					'title'=> $_POST['title'],
					'Author'=> $_POST['author'],
					'Publisher'=> $_POST['publisher'],
					'Medium'=> $_POST['medium'],
					'Edition'=> $_POST['edition'],
					'subno'=> $_POST['lastcat'],
					'ISBN'=> $_POST['isbn'],
					'Pages'=> $_POST['pages'],
					'Binding'=> $_POST['bind'],
					'MRP'=> $_POST['mrp'],
					'Discount'=> $_POST['discount'],
					'image' => $img,
					'backimg' =>$backimg,
						  'charges' => $_POST['charges'],
                );
                $this->Store->insertbook($data);
                redirect(site_url('home/inventory'));
              

	}

	function editbook($id)
	{
		$data['book']=$this->Store->getbookdetails($id);
		$this->load->view('editbook',$data);
	}

	function updatebook()
	{
		if (!isset($_POST['bookid'])) {
			echo "Something went wrong";
		}

		$data['book']=$this->Store->getbookdetails($_POST['bookid']);
		foreach ($data['book'] as $row) {
			$curimg=$row->image;
			$curbackimg=$row->backimg;
		}

		if ($_POST['subcat']==NULL || $_POST['lastcat']==NULL) {
			echo "Select a category and subcategory";
		}
		else
		{
			if ($_FILES['cover']['error']!=4 && $_FILES['cover']['error']==0) {
				$path='./assets/images/'.$curimg;
				unlink($path);
				$path2='./assets/thumbnails/'.$curimg;
				unlink($path2);

				$config['upload_path']          = './assets/images/';
                $config['allowed_types']        = 'gif|jpeg|png|jpg|bmp';
                $config['max_size']             = 20000;
                $config['max_width']            = 10000;
                $config['max_height']           = 10000;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('cover'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $img=NULL;
                        print_r($error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                      $img=$data['upload_data']['file_name'];
                $config1['image_library'] = 'gd2';
                $config1['source_image'] = './assets/images/'.$img;
                $config1['new_image'] = './assets/thumbnails/';
                $config1['create_thumb'] = TRUE;
                $config1['maintain_ratio'] = TRUE;
                $config1['thumb_marker']='';
                $config1['width']         = 300;
                $config1['height']       = 600;

				$this->load->library('image_lib', $config1);

				$this->image_lib->resize();
				unset($this->upload);
				unset($this->image_lib);
                 }

                  $data=array(
                	'catno'=> $_POST['subcat'],
					'title'=> $_POST['title'],
					'Author'=> $_POST['author'],
					'Publisher'=> $_POST['publisher'],
					'Medium'=> $_POST['medium'],
					'Edition'=> $_POST['edition'],
					'subno'=> $_POST['lastcat'],
					'ISBN'=> $_POST['isbn'],
					'Pages'=> $_POST['pages'],
					'Binding'=> $_POST['bind'],
					'MRP'=> $_POST['mrp'],
					'Discount'=> $_POST['discount'],
					'image' => $img,
					  'charges' => $_POST['charges'],
					  'availability' => $_POST['avail'],
				);
					$this->Store->updatebook($data,$_POST['bookid']);

					if($_FILES['backcover']['error']!=4 && $_FILES['backcover']['error']==0)
			{
				$path='./assets/images/'.$curbackimg;
				unlink($path);
				$path2='./assets/thumbnails/'.$curbackimg;
				unlink($path2);

				$config['upload_path']          = './assets/images/';
                $config['allowed_types']        = 'gif|jpeg|png|jpg|bmp';
                $config['max_size']             = 20000;
                $config['max_width']            = 10000;
                $config['max_height']           = 10000;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('backcover'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $backimg=NULL;
                        print_r($error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                      $backimg=$data['upload_data']['file_name'];
                $config1['image_library'] = 'gd2';
                $config1['source_image'] = './assets/images/'.$backimg;
                $config1['new_image'] = './assets/thumbnails/';
                $config1['create_thumb'] = TRUE;
                $config1['maintain_ratio'] = TRUE;
                $config1['thumb_marker']='';
                $config1['width']         = 300;
                $config1['height']       = 600;

				$this->load->library('image_lib', $config1);

				$this->image_lib->resize();
				unset($this->upload);
				unset($this->image_lib);
                 }

                  $data=array(
                	'catno'=> $_POST['subcat'],
					'title'=> $_POST['title'],
					'Author'=> $_POST['author'],
					'Publisher'=> $_POST['publisher'],
					'Medium'=> $_POST['medium'],
					'Edition'=> $_POST['edition'],
					'subno'=> $_POST['lastcat'],
					'ISBN'=> $_POST['isbn'],
					'Pages'=> $_POST['pages'],
					'Binding'=> $_POST['bind'],
					'MRP'=> $_POST['mrp'],
					'Discount'=> $_POST['discount'],
					'backimg' => $backimg,
					  'charges' => $_POST['charges'],
					  'availability' => $_POST['avail'],
				);
					$this->Store->updatebook($data,$_POST['bookid']);
			}
			}

			else if($_FILES['backcover']['error']!=4 && $_FILES['backcover']['error']==0)
			{
				$path='./assets/images/'.$curbackimg;
				unlink($path);
				$path2='./assets/thumbnails/'.$curbackimg;
				unlink($path2);

				$config['upload_path']          = './assets/images/';
                $config['allowed_types']        = 'gif|jpeg|png|jpg|bmp';
                $config['max_size']             = 20000;
                $config['max_width']            = 10000;
                $config['max_height']           = 10000;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('backcover'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $backimg=NULL;
                        print_r($error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                      $backimg=$data['upload_data']['file_name'];
                $config1['image_library'] = 'gd2';
                $config1['source_image'] = './assets/images/'.$backimg;
                $config1['new_image'] = './assets/thumbnails/';
                $config1['create_thumb'] = TRUE;
                $config1['maintain_ratio'] = TRUE;
                $config1['thumb_marker']='';
                $config1['width']         = 300;
                $config1['height']       = 600;

				$this->load->library('image_lib', $config1);

				$this->image_lib->resize();
				unset($this->upload);
				unset($this->image_lib);
                 }

                  $data=array(
                	'catno'=> $_POST['subcat'],
					'title'=> $_POST['title'],
					'Author'=> $_POST['author'],
					'Publisher'=> $_POST['publisher'],
					'Medium'=> $_POST['medium'],
					'Edition'=> $_POST['edition'],
					'subno'=> $_POST['lastcat'],
					'ISBN'=> $_POST['isbn'],
					'Pages'=> $_POST['pages'],
					'Binding'=> $_POST['bind'],
					'MRP'=> $_POST['mrp'],
					'Discount'=> $_POST['discount'],
					'backimg' => $backimg,
					  'charges' => $_POST['charges'],
					  'availability' => $_POST['avail'],
				);
					$this->Store->updatebook($data,$_POST['bookid']);
			}


			else
			{
				 $data=array(
                	'catno'=> $_POST['subcat'],
					'title'=> $_POST['title'],
					'Author'=> $_POST['author'],
					'Publisher'=> $_POST['publisher'],
					'Medium'=> $_POST['medium'],
					'Edition'=> $_POST['edition'],
					'subno'=> $_POST['lastcat'],
					'ISBN'=> $_POST['isbn'],
					'Pages'=> $_POST['pages'],
					'Binding'=> $_POST['bind'],
					'MRP'=> $_POST['mrp'],
					'Discount'=> $_POST['discount'],
					 'charges' => $_POST['charges'],
					 'availability' => $_POST['avail'],
				);
					$this->Store->updatebook($data,$_POST['bookid']);
			}

		}

		redirect(site_url('home/inventory'));
		
	}


	function deletebook($id)
	{
		$data['book']=$this->Store->getbookdetails($id);
		foreach ($data['book'] as $row) {
			$img=$row->image;
			$backimg=$row->backimg;
		}

		$path='./assets/images/'.$img;
		unlink($path);
		$path2='./assets/thumbnails/'.$img;
		unlink($path2);
		$path3='./assets/thumbnails/'.$backimg;
		unlink($path3);
		$path4='./assets/thumbnails/'.$backimg;
		unlink($path4);
		$this->Store->deletebook($id);
		redirect(site_url('home/inventory'));

	}

	function settings(){
		$data['category']=$this->Store->getcategories();
		$this->load->view('settings',$data);
	}

	function loadcategory($id){
		$data['classes'] = $this->Store->loadClasses($id);
		$data['category'] = $id;
		$this->load->view('classes',$data);
	}

	function loadClass($id){
		$data['subjects'] = $this->Store->loadSubjects($id);
		$data['class'] = $id;
		$this->load->view('subjects',$data);
	}

	function newcategory(){
		$data = array(
			'name' => $this->input->post('category')
		);
		$this->Store->addnewcategory($data);
		redirect(site_url('home/settings'));
	}

	function newClass(){
		$data = array(
			'name' => $this->input->post('class'),
			'subno' => $this->input->post('category')
		);
		$this->Store->addnewClass($data);
		redirect(site_url('home/loadcategory/').$this->input->post('category'));
	}

	function newSubject(){
		$data = array(
			'name' => $this->input->post('subject'),
			'subno' => $this->input->post('class')
		);
		$this->Store->addnewSubject($data);
		redirect(site_url('home/loadclass/').$this->input->post('class'));
	}


	function deletesubject($id){
		$this->Store->deleteSubject($id);
		redirect(site_url('home/settings'));
	}

	function deleteclass($id){
		$this->Store->deleteClass($id);
		redirect(site_url('home/settings'));
	}

	function deletecategory($id){
		$this->Store->deleteCategory($id);
		redirect(site_url('home/settings'));
	}

	function logout(){
		session_start();
		unset($_SESSION);
		session_destroy();
		redirect(site_url('login'));
	}
}

?>
