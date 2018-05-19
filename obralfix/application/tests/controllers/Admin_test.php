<?php



class Admin_test extends TestCase {


    public function test_index()

    {

        $output = $this->request('GET', ['Admin','index']);
        $expected ="<h3>Product Overview</h3>";
        $this->assertcontains($expected, $output);
    }


}