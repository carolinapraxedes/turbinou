<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passeio extends Model
{
    use HasFactory;
    protected $table = 'passeio';

    protected $fillable = [
        'destino_id',
        'nome',
        'horario',
        'descricao',
    ];

    public function rules()
    {   return [
            'destino_id' => 'required|exists:destinos,id',
            'nome' => 'required|string|max:255',
            'horario' => 'required|in:Manhã,Tarde,Noite',
            'descricao' => 'nullable|string|max:260',
        ];
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class); 
    }

}
