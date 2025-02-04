<?php

namespace App\Models;
use App\Models\organ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    use HasFactory;
    protected $fillable = ['objet', 'details', 'id_organs','date_reunion','salle','heure'];  // Champs modifiables
    protected $table='reunions';
    /**
     * Obtenir l'organe auquel appartient la réunion.
     */
    public function organ()
    {
        return $this->belongsTo(Organ::class, 'id_organs');  // Relation Many-to-One
    }
}
