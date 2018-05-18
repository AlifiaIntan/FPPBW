<?php



class Login_test extends TestCase {

	

	

    public function test_index()

	{

		$output = $this->request('GET', 'Login');

		$this->assertContains('<title>Share-it-up! : Login Page</title>', $output); 

	}



        public function test_aksi_login() //user benar password benar (ADMIN)

    {    

        $output = $this->request('POST', 'Login/aksi_login', 

					['username' => 'admin',

					 'password' => 'admin'

					 ]);

        $this->assertEquals('admin', $_SESSION['username'], $output);

        $this->assertRedirect('Home_admin');

    }

    

    public function test_aksi_loginUser() //user benar password benar (USER)

    {    

        $output = $this->request('POST', 'Login/aksi_login', 

					['username' => 'achmadz',

					 'password' => 'zakaria'

					 ]);

        $this->assertEquals('achmadz', $_SESSION['username'], $output);

        $this->assertRedirect('Home');

    }

    

    public function test_aksi_login_bukanuser() //user salah password salah (ADMIN)

    {

        $output = $this->request('POST', 'Login/aksi_login',

                [

                    'username' => 'admin1',

                    'password' => 'admin123',

                ]);

        

        $this->assertFalse(isset($_SESSION['username'], $output));

        $this->assertRedirect('Login');

    }

	

	public function test_aksi_login_userbenar() //user benar password salah

    {

        $output = $this->request('POST', 'Login/aksi_login',

                [

                    'username' => 'admin',

                    'password' => 'passnya salah',

                ]);

        

        $this->assertFalse(isset($_SESSION['username'], $output));

        $this->assertRedirect('Login');

    }

	

	public function test_aksi_login_usersalah() //user salah password benar

    {

        $output = $this->request('POST', 'Login/aksi_login',

                [

                    'username' => 'usernyasalah',

                    'password' => 'zakaria',

                ]);

        

        $this->assertFalse(isset($_SESSION['username'], $output));

        $this->assertRedirect('Login');

    }



    public function test_aksi_login_kosong(){ //user passwd kosong



        $this->request('POST', 'Login/aksi_login',

                [

                    'username' => '',

                    'password' => '',

                ]);





        $this->assertFalse(isset($_SESSION['username']));

        $this->assertRedirect('Login');

    }

	

	public function test_aksi_login_userisibenar(){ //user diisi benar passwd kosong



        $this->request('POST', 'Login/aksi_login',

                [

                    'username' => 'achmadz',

                    'password' => '',

                ]);





        $this->assertFalse(isset($_SESSION['username']));

        $this->assertRedirect('Login');

    }

	

	public function test_aksi_login_userisisalah(){ //user diisi salah password kosong



        $this->request('POST', 'Login/aksi_login',

                [

                    'username' => 'adchmadz1234',

                    'password' => '',

                ]);





        $this->assertFalse(isset($_SESSION['username']));

        $this->assertRedirect('Login');

    }

	

	public function test_aksi_login_passwdisibenar(){ //user kosong passwd benar



        $this->request('POST', 'Login/aksi_login',

                [

                    'username' => '',

                    'password' => 'zakaria',

                ]);





        $this->assertFalse(isset($_SESSION['username']));

        $this->assertRedirect('Login');

    }

	

	public function test_aksi_login_passwdisisalah(){ //user kosong password alah



        $this->request('POST', 'Login/aksi_login',

                [

                    'username' => '',

                    'password' => 'zakariaaa',

                ]);





        $this->assertFalse(isset($_SESSION['username']));

        $this->assertRedirect('Login');

    }

  

}