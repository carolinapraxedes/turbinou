<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;
    protected $table = 'destino';

    protected $fillable = [
        'cidade',
        'estado',
    ];

    public function rules(){
        return[
            'cidade' => 'required|string|max:255',
            'estado' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
        ];
        
    }

    public function feedback(){
        return [
            'cidade.required' => 'Informe o nome da cidade',
            'cidade.max' => 'A cidade deve ter no máximo 255 caracteres',
            'estado.required' => 'Necessário escolher um estado!',
        ];
    }

    public function passeios()
    {
        return $this->hasMany(Passeio::class);
    }
}
