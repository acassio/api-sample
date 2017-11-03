<?php


use App\Usuario;
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
                'total_faturas'=>2
            ]);

        $response->assertStatus(200)
                 ->assertJson(['cpf' => '777.777.777-77']);
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
            ->assertStatus(200);
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
            'data_nascimento' => '1989-08-20',
            'total_faturas'=>3
        ]);

        $response = $this->laravel->post('/api/fatura', [
            'usuario_id' => $user->id,
            'nome_empresa' => 'Tilix',
            'valor' => 100,
            'data_vencimento' => '2017-12-25',
            'pagou' => 0
        ]);

        $response->assertStatus(200);

    });


     it('ver fatura', function ()
    {
        $fatura = Fatura::first();
        $this->laravel->get('/api/fatura/'.$fatura->id)
            ->assertStatus(200);
    });


     it('editar fatura', function ()
    {
        $fatura = Fatura::first();
        $response = $this->laravel->put('/api/fatura/'.$fatura->id , [
            'data_vencimento'=>'2017-12-31',
            'valor' => 50.5
        ]);
        $response->assertStatus(200)
            ->assertJson(['data_vencimento' => '2017-12-31']);
    });

      it('ver todas faturas', function ()
    {

         $this->laravel->get('/api/fatura')
                         ->assertStatus(200);        
    });


     it('deletar fatura', function ()
    {

        $fatura = Fatura::first();     
        $user = Usuario::find($fatura->usuario_id);

        $this->laravel->delete('/api/fatura/'.$fatura->id)
                      ->assertStatus(200);        
        $user->delete();                      
    });







});

