<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	public function __construct(){
	parent::__construct();
	$this->load->model('M_admin');
	}

	public function index()
	{
	$this->load->view('Admin/header');
    $this->load->view('Admin/index');
    $this->load->view('Admin/footer');
	}

	function basic(){
	$data = array();
	$data['products'] = $this->M_admin->tampil_data();
	$this->load->view('Admin/header');
    $this->load->view('Admin/basic-table',$data);
    $this->load->view('Admin/footer');
	}

	function publish(){
	$data = array();
	$data['otherImgs'] = $this->loadOthersImages();
	$this->load->view('Admin/header');
    $this->load->view('Admin/publish',$data);
    $this->load->view('Admin/footer');
	}

	function edit($id){
		$data = array();
		$data['otherImgs'] = $this->loadOthersImages();
	  	$data['product'] = $this->M_admin->getOneProduct($id);	

		$this->load->view('Admin/header');
	    $this->load->view('Admin/edit', $data);
	    $this->load->view('Admin/footer');
	}

    public function do_upload_others_images()
    {
            $upath = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
            if (!file_exists($upath)) {
                mkdir($upath, 0777);
            }

          
            $this->load->library('upload');

            $files = $_FILES;
            $cpt = count($_FILES['others']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                unset($_FILES);
                $_FILES['others']['name'] = $files['others']['name'][$i];
                $_FILES['others']['type'] = $files['others']['type'][$i];
                $_FILES['others']['tmp_name'] = $files['others']['tmp_name'][$i];
                $_FILES['others']['error'] = $files['others']['error'][$i];
                $_FILES['others']['size'] = $files['others']['size'][$i];

                $this->upload->initialize(array(
                    'upload_path' => $upath,
                    'allowed_types' => 'gif|jpg|png'
                ));
                $this->upload->do_upload('others');
            }
        
    }


	public function loadOthersImages()
    {
        $output = '';
        if (isset($_POST['folder']) && $_POST['folder'] != null) {
            $dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    $i = 0;
                    while (($file = readdir($dh)) !== false) {
                        if (is_file($dir . $file)) {
                            $output .= '
                                <div class="other-img" id="image-container-' . $i . '">
                                    <img src="' . base_url('attachments/shop_images/' . $_POST['folder'] . '/' . $file) . '" style="width:100px; height: 100px;">
                                    <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\', \'' . $_POST['folder'] . '\', ' . $i . ')">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </div>
                               ';
                        }
                        $i++;
                    }
                    closedir($dh);
                }
            }
        }
        if ($this->input->is_ajax_request()) {
            echo $output;
        } else {
            return $output;
        }
    }

    private function uploadImage()
    {
        $config['upload_path'] = './attachments/shop_images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 4000;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('userfile')) {
            log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
        }
        $img = $this->upload->data();
        return $img['file_name'];
    }



    function add(){
    $tittle = $this->input->post('tittle');
    $basic_description = $this->input->post('basic');
    $description = $this->input->post('description');
    $price = $this->input->post('price');
    $discount = $this->input->post('discount');
    $quantity = $this->input->post('quantity');
    $in_slider = $this->input->post('in_slider');
	$folder = $this->input->post('folder');
    $userfile = $this->uploadImage();

	$this->do_upload_others_images();


    $data = array(
            'tittle' => $tittle,
            'basic_description' => $basic_description,
            'price' => $price,
      		'discount' => $discount,
      		'quantity' => $quantity,
      		'in_slider' => $in_slider,
      		'image' => $userfile,
      		'folder' => $folder

            );
        $this->M_admin->input_data($data,'products');
        redirect('welcome');
    }

    function update($id) {
    $tittle = $this->input->post('tittle');
    $basic_description = $this->input->post('basic');
    $description = $this->input->post('description');
    $price = $this->input->post('price');
    $discount = $this->input->post('discount');
    $quantity = $this->input->post('quantity');
    $in_slider = $this->input->post('in_slider');
    $userfile = $this->uploadImage();

    $oldProduct = $this->M_admin->getOneProduct($id);
    unlink('attachments/shop_images/'.$oldProduct['image']); 
    $this->removeSecondaryImage($oldProduct['folder']);

    $this->do_upload_others_images();

    $data = array(
            'tittle' => $tittle,
            'basic_description' => $basic_description,
            'price' => $price,
      		'discount' => $discount,
      		'quantity' => $quantity,
      		'in_slider' => $in_slider,
      		'image' => $userfile,

			);

    $where = array('id' => $id);

    $this->M_admin->update_data($where,$data,'products');
    redirect('admin/');
  }

  function hapus($id){
  $where = array('id' => $id);
  $this->m_admin->hapus_data($where,'kritik');
  redirect('admin/index');
  }


    public function removeSecondaryImage($folder)
    {
        if ($this->input->is_ajax_request()) {
            $img = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . '' . $folder;
            unlink($img);
        }
    }

}
