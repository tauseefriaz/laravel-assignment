<?php

namespace Tests\Feature;

use Input;
use Session;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {

        Session::start();
        $input = [
        	'_token' => csrf_token(), 
        	'data' => ['parent_id' => 1, 'name' => 'Foo Bar', 'comment' => 'Foo Bar Comment']];
        Input::replace($input);

        $response = $this->call('POST', '/comments/save', $input);
        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => '*',
         	]);

    }
}
