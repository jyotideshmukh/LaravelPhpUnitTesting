<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * Check use has taxonomies
     */

    public function test_is_user_has_taxonomies(){
        $user = User::factory()->create();
        $this->assertInstanceOf(Collection::class,$user->taxonomies);
        //
        //$this->assertTrue(true);
    }
}
