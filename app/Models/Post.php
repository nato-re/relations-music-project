<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Define explicitamente o nome da tabela no banco de dados (plural correto em português)
    protected $table = 'posts';

    // Campos que podem ser preenchidos em massa (Mass Assignment)
    protected $fillable = [
        'user_id',
        'conteudo',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
