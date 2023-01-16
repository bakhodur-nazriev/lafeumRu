<?php

namespace Tests\Feature;

use App\Favorite;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guests_can_not_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post('quotes/1/favorites')
            ->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_quote()
    {
        $this->signIn();

        $quote = create('App\Quote');

        $this->post('quotes/' . $quote->id . '/favorites');

        $this->assertCount(1, $quote->favorites);
    }

    /** @test */
    function an_authenticated_user_may_only_favorite_a_quote_once()
    {
        $this->signIn();

        $quote = create('App\Quote');

        $this->post('quotes/' . $quote->id . '/favorites');
        $this->post('quotes/' . $quote->id . '/favorites');

        $this->assertCount(1, $quote->favorites);
    }
}
