<?php namespace Test\Example\Model;

class BbsTest
{

    public function test_post() {
        $bbs = new Bbs();
        $bbs->post('message');
        $this->assertEquals(['message'],$bbs->get_posts());
    }

}
