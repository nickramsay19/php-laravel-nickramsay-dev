<?php

namespace Tests\Feature;
 
use Tests\TestCase;
 
class PostTest extends TestCase {
    public function test_view_show_not_found(): void {
        $view = $this->view('pages.posts.show', [
            'post' => null,
        ]);
 
        $view->assertSee('There is no post with by this name.');
    }
}