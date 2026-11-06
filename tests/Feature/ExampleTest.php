<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * La página principal redirige al catálogo de zapatos.
     */
    public function test_la_pagina_principal_redirige_al_catalogo(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/zapatos');
    }
}
