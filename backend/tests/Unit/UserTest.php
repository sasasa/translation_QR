<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;

use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use ArraySimilarTrait;

    private $attributes;

    public function setUp(): void
    {
        parent::setUp();
    }
    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }


    public function test_getPermissionJpAttribute()
    {
        $user = User::create([
            'name'     => 'テスト太郎',
            'email'     => 'hoge@example.com',
            'password' => bcrypt('test'),
            'permission' => User::EDITING,
        ]);
        $this->assertSame($user->permission_jp, '編集権限');
    }
}