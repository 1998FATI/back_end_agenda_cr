<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organ extends Model
{
    use HasFactory;
    protected $fillable = ['libelle'];  // Champs modifiables
    protected $table='organs';

    /**
     * Récupérer les réunions associées à l'organ.
     */
    public function reunions()
    {
        return $this->hasMany(Reunion::class, 'id_organs');  // Relation One-to-Many
    }

}
