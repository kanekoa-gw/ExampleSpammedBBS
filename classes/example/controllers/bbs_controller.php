<?php

class BbsController
{

    public function index() {
        $bbs = new Bbs();
        $posts = $bbs->get_posts();
        $this->assign('posts', $posts);
    }

    public function post($body) {

        if (Cookie::is_past_enabled_time()) {
            $this->alert(sprintf(
                "%d時間は投稿できません。あなたが書き込みできるまであと%d分です。",
                Cookie::hour_for_filter(),
                Cookie::get_remaining_time()
            ));
        }
        else {
            $bbs = new Bbs();
            $bbs->post($body);
        }

        $this->redirect('/bbs/index');
    }

}
