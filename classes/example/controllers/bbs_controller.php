<?php

class BbsController
{

    public function index() {
        $bbs = new Bbs();
        $posts = $bbs->get_posts();
        $this->assign('posts', $posts);
    }

    public function post($body) {
        $bbs = new Bbs();
        $bbs->post($body);
        $this->redirect('/bbs/index');
    }

}
