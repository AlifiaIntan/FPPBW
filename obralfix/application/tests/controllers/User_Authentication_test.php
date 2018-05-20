<?php



class User_Authentication_test extends TestCase {


        public function test_index()

    {

        $output = $this->request('GET', ['User_Authentication','index']);
        $expected ="Please Login";
        $this->assertcontains($expected, $output);
    }

    public function test_user_login_process() //user benar password benar (ADMIN)

    {    

        $output = $this->request('POST', 'User_Authentication/admin_login_process', 

                    [

                    'user_name' => 'admin',

                     'password' => 'admin'

                     ]
                 );

         $this->assertEquals($_SESSION['role']);
        //$this->assertEquals('admin', $_SESSION['role'], $output);

    }

    public function test_login_gaada_isinya()
    {
        $output = $this->request(                                                               
        'POST',                                         
        'User_Authentication/admin_login_process',                         
            [                                           
                'username' => '',       
                'password' => ''                     
            ]                                              
    );                

                   
        $this->assertEquals('',$_SESSION['status']);
        $this->assertContains('Admin Login',$output);
    }

    public function test_login_password_user()
    {
        $output = $this->request(                                                               
        'POST',                                         
        'User_Authentication/user_login_process',                         
            [                                           
                'username' => 'admin',       
                'password' => 'admin'                     
            ]                                              
    );                                                            
        $this->assertEquals('', $_SESSION['status']);
        $this->assertContains('Your Email is alfarisii1998@gmail.com', $output);
    }

        public function test_Logout()

    {

        $output = $this->request('User_Authentication/logout');
        $expected ="Login";
        $this->assertcontains($expected, $output);
    }


        public function test_login_password_salah()
    {
        $output = $this->request(                                                               
        'POST',                                         
        'User_Authentication/User_login_process',                         
            [                                           
                'username' => 'admin',       
                'password' => 'abc'                     
            ]                                              
    );                                                            
        $this->assertEquals('', $_SESSION['status']);
        $this->assertContains('', $output);
    }

    public function test_login_username_salah()
    {
        $output = $this->request(                                                               
        'POST',                                         
        'User_Authentication/Admin_login_process',                         
            [                                           
                'username' => 'abc',       
                'password' => 'admin'                     
            ]                                              
    );                                                            
        $this->assertEquals('', $_SESSION['status']);
        $this->assertContains('', $output);
    }
      public function test_login_22nya_salah()
    {
        $output = $this->request(                                                               
        'POST',                                         
        'User_Authentication/Admin_login_process',                         
            [                                           
                'username' => 'alfarisi',       
                'password' => 'ehehe'                     
            ]                                              
    );                                                            
        $this->assertEquals('', $_SESSION['status']);
        $this->assertContains('', $output);
    }
}