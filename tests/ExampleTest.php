<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        // We need two users, and each of them needs 10 books
        factory(App\User::class, 2)->create()->each(function($user) {
            $user->books()->saveMany(
                factory(App\Book::class, 10)->make()
            );
        });

        // Get a collection of all (two) users
        $users = App\User::all();

        // Let's only load 5 (five) of their related books
        $users->load(['books' => function($query) {
            $query->take(5);
        }]);

        $users->each(function($user) {
            $this->assertCount(5, $user->getRelation('books'));
        });
    }
}
