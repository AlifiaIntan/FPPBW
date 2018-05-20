<?php



class Admin_test extends TestCase {


    public function test_index()

    {

        $output = $this->request('Admin/index');
        $expected ="Basic Table";
        $this->assertcontains($expected, $output);
    }


}