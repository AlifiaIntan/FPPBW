<?php



class Login_test extends TestCase {

	

	

    public function test_index()

	{

		$output = $this->request('GET', 'user_authentication/user_login_process');

		$this->assertContains('Please Login', $output); 

	}



    public function test_aksi_login() //user benar password benar (ADMIN)

    {    

        $output = $this->request('POST', 'user_authentication/user_login_process', 

					['username' => 'admin',

					 'password' => 'admin'

					 ]);


        $this->assertEquals('admin', $this->session->userdata('role');, $output);

        $this->assertRedirect('user_authentication/user_login_process');

    }

}