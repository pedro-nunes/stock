<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'category_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    /**
     * Converter todas as palavras para caixa
     * @param string $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = Str::lower($name);
    }
    /**
     * Exibir o nome da categoria em caixa alta
     * @param string $name
     */
    public function getNameAttribute($name)
    {
        return Str::title($name);
    }
}
