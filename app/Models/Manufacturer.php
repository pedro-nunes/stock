<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Manufacturer extends Model
{
    use HasFactory;

    protected $table = 'manufacturers';
    protected $fillable = [
        'name',
        'slug',
        //imagem
    ];

    /**
     * Relaciona com a tabela de produtos
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'manufacturer_id', 'id');
    }

    /**
     * Converter todas as palavras letras para minuscúla
     * @param string $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = Str::lower($name);
    }
    /**
     * Exibir o nome do fabricante com a primeira letra maiúscula
     * @param string $name
     */
    public function getNameAttribute($name)
    {
        return Str::title($name);
    }
}
