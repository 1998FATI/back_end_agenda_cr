<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextLoi extends Model
{
    use HasFactory;
    protected $fillable = ['titre','pdf'];  
    protected $table='texte_lois';

}
