<?php


use Acassio\Core\Models\Usuario;
use Acassio\Core\Models\Fatura;

describe('teste usuario', function ()
{
    
    it('cadastro de usuario', function ()
    {

        $response = $this->laravel->post('/api/usuario',
            [
                'nome' => 'Acassio Marques',
                'cpf'  => '812.718.912-17',
                'data_nascimento' => '1989-08-20'
            ]);

        $response->assertStatus(200)
                 ->assertJson(['nome' => 'Acassio Marques']);
    });

   

});

