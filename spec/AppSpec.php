<?php


use Acassio\Core\Models\Usuario;
use Acassio\Core\Models\Fatura;

describe('teste usuario', function ()
{
    
    it('cadastrar novo usuario', function ()
    {

        $response = $this->laravel->post('/api/usuario',
            [
                'nome' => 'Acassio Marques',
                'cpf'  => '777.777.777-77',
                'data_nascimento' => '1989-08-20',
                'total_faturas'=>0
            ]);

        $response->assertStatus(200)
                 ->assertJson(['nome' => 'Acassio Marques']);
    });


     it('ver usuario', function ()
    {
        $user = Usuario::where('nome','=','Acassio Marques')->first();
        $this->laravel->get('/api/usuario/'.$user->id)
            ->assertStatus(200)
            ->assertJson(['nome' => 'Acassio Marques']);
    });


     it('editar usuario', function ()
    {
        $user = Usuario::where('nome','=','Acassio Marques')->first();
        
        $response = $this->laravel->put('/api/usuario/'.$user->id , [
            'cpf' => '888.888.888-88'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['cpf' => '888.888.888-88']);
    });


     it('listar todos usuarios', function ()
    {
        $this->laravel->get('/api/usuario')
            ->assertStatus(200)
            ->assertJsonFragment(['nome' => 'Acassio Marques']);
    });


     it('deletar usuario', function ()
    {        

        $user = Usuario::where('nome','=','Acassio Marques')->first();
        $this->laravel->delete('/api/usuario/'.$user->id)->assertStatus(200);

    });

});



describe('teste fatura', function ()
{
        
    it('cadastrar nova fatura', function ()
    {
        $user = Usuario::create([
            'nome' => 'Acassio Marques',
            'cpf' => '495.324.154-12',
            'data_nascimento' => '1989-08-20'
        ]);

        $response = $this->laravel->post('/api/fatura', [
            'usuario_id' => $user->id,
            'nome_empresa' => 'Empresa de Teste',
            'valor' => 100,
            'data_vencimento' => '2017-12-25',
            'paid' => 0
        ]);

        $response->assertStatus(200);

    });


});

