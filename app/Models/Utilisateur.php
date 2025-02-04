<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Utilisateur extends Authenticatable
{


    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'login', 'password', 'name', 'prenom'
    ];

    // Champs à cacher dans les réponses JSON
    protected $hidden = [
        'password', 'remember_token',
    ];

 
}
