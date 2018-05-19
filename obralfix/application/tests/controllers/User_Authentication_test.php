<?php



class User_Authentication_test extends TestCase {


    public function test_user_login_process() //user benar password benar (ADMIN)

    {    

        $output = $this->request('POST', 'User_Authentication/user_login_process', 

                    [

                    'username' => 'admin',

                     'password' => 'admin'

                     ]
                 );

         $this->assertEquals('Admin', $_SESSION['status'],$output);
        $this->assertRedirect('Admin');
        //$this->assertEquals('admin', $_SESSION['role'], $output);

    }

}