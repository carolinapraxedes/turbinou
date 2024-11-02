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
        'imagem',
        'descricao',
    ];

    public function rules()
    {   return [
            'destino_id' => 'required|exists:destino,id',
            'nome' => 'required|string|max:255',
            'horario' => 'required|in:morning,afternoon,night',
            'imagem' => 'nullable',
            'descricao' => 'nullable|string|max:260',
        ];
    }

    public function feedback(){
        return [
            'required.destino' => 'Necessário escolher um destino!',
            'nome.required' => 'Informe o nome do passeio',
            'nome.unique' => 'O passeio já existe',
            'name.max' => 'O passeio deve ter no máximo 255 caracteres',
            'horario.required' => 'O horário é obrigatório.',
            'horario.in' => 'O horário selecionado é inválido.',
           
            
        ];
    }


    public function destino()
    {
        return $this->belongsTo(Destino::class); 
    }

}
