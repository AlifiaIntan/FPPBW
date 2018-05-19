<?php


Class Mailer extends CI_Controller {

  public function mail() {

    $head = array();
    $data = array();
    $name = $this->input->post('name');
    $mail = $this->input->post('email');
    $message = $this->input->post('msg');

    $data = array(
        'Nama' => $name,
        'Email' => $mail,
        'Pesan' => $message,
    );

    $this->db->insert('kontak', $data);

    redirect('Home/Contact');
  }

}
