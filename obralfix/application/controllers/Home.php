<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	$data = array();
	$data['sliderProducts'] = $this->M_admin->getSliderProducts();
	$data['newProducts'] = $this->M_admin->getNewProducts();
	$this->load->view('header');
    $this->load->view('index2',$data);
    $this->load->view('footer');
	}

	function about(){
	$this->load->view('header');
    $this->load->view('about');
    $this->load->view('footer');
	}

	function viewProduct($id)
    {
    $data = array();
    $data['product'] = $this->M_admin->getOneProduct($id);
    $data['sameCagegoryProduct'] = $this->M_admin->sameCagegoryProducts($data['product']['shop_categorie'], $id);
    if ($data['product'] === null) {
         show_404();
    }
    $this->load->view('header');
    $this->load->view('view_product',$data);
    $this->load->view('footer');
    }

	function product(){
	$data = array();
	$data['newProducts'] = $this->M_admin->getNewProducts();
	$this->load->view('header');
    $this->load->view('product',$data);
    $this->load->view('footer');
	}

	function contact(){
	$data = array();
	$this->load->view('header');
    $this->load->view('Contact');
    $this->load->view('footer');
	}

	function checkout(){
	$this->load->view('header');
    $this->load->view('checkout');
    $this->load->view('footer');
	}

	function Register(){
	$this->load->view('header');
    $this->load->view('Register');
    $this->load->view('footer');
	}

}
