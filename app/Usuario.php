<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Acassio\Core\Models\Usuario as UsuarioCore;

class Usuario extends UsuarioCore
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'id', 'nome', 'cpf', 'data_nascimento','total_faturas'
    ];

}
