<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * The root URL redirects to the Arabic locale.
     */
    public function test_the_application_redirects_to_locale(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/ar');
    }
}
