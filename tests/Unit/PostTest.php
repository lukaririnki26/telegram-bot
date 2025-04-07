<?php

namespace Tests\Unit;

use App\Models\Posts;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_post()
    {
        $post = Posts::create($data = [
            'title' => 'test title',
            'body' => 'test body',
        ]);

        $this->assertEquals($data['title'], $post->title);
        $this->assertEquals($data['body'], $post->body);
    }
}
