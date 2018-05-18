<?php

class Admin extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model('m_admin');
    $this->load->helper('url');
        if($this->session->userdata('status') != "login"){
      redirect(base_url("login"));
    }
  }

  function index(){
    $data['users'] = $this->m_admin->tampil_data()->result();
    $this->load->view('v_admin',$data);
  }

  function edit($id){
    $where = array('id' => $id);
    $data['users'] = $this->m_admin->edit_data($where,'users')->result();
    $this->load->view('v_edit',$data);
  }

  function update(){
    $id = $this->input->post('id');
    $nama = $this->input->post('name');
    $email = $this->input->post('email');
	 $subject = $this->input->post('subject');
    $message = $this->input->post('message');

    $data = array(
			'name' => $nama,
			'email' => $email,
			'subject' => $subject,
            'message' => $message

			);

    $where = array('id' => $id);

    $this->m_admin->update_data($where,$data,'users');
    redirect('admin/');
  }

  function hapus($id){
  $where = array('id' => $id);
  $this->m_admin->hapus_data($where,'users');
  redirect('admin/index');
  }

  function tambah_aksi(){
    echo(date("Y-m-d",$t));
		$Nama = $this->input->post('name');
		$Email = $this->input->post('email');
		$Subject = $this->input->post('subject');
    $Message = $this->input->post('message');
    $date = date('m');

    $data = array(
    	'name' => $Nama,
			'email' => $Email,
      'date' => $date,
			'subject' => $Subject,
      'message' => $Message

			);
		$this->m_admin->input_data($data,'users');
		redirect('welcome');
}
      function export(){
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Report.xls");
    
    $data['users'] = $this->m_admin->tampil_data()->result();
    $this->load->view('v_admin',$data);
    }
}
