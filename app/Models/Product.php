<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'code',
        'name',
        'slug',
        'category_id',
        'manufacturer_id',
        'vendor_id',
        'sale_price',
        'cost_price',
        'min_stock',
        'variation',
        'status',
        'thumbnail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id', 'id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class,'manufacturer_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id', 'id');
    }

    /**
     * Converter todas as letras de todas as palavras para caixa baixa
     * @param string $variation
     */
    public function setVariationAttribute($variation)
    {
        $this->attributes['variation'] = Str::title($variation);
    }

    /**
     * Converte o campo Preço de Venda no padão americano para salvar no banco de dados
     * @param string $value
     */
    public function setSalePriceAttribute($value)
    {
        $this->attributes['sale_price'] = floatval($this->convertStringToDouble($value));
    }

    /**
     * Converte o campo Preço de Custo no padão americano para salvar no banco de dados
     * @param string $value
     */
    public function setCostPriceAttribute($value)
    {
        $this->attributes['cost_price'] = floatval($this->convertStringToDouble($value));
    }

    /**
     * Converte o campo Preço de Venda para moeda BRL
     * @param string $value
     *
     * @return string
     */
    public function getSalePriceAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
    /**
     * Converte o campo Preço de Custo para moeda BRL

     * @param string $value
     *
     * @return string
     */
    public function getCostPriceAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    /**
     * Substitui o ponto e virgula da casa decimal aceito pelo banco de dados
     * @param string $param
     *
     * @return string
     */
    private function convertStringToDouble($param)
    {
        return str_replace(',', '.', str_replace('.', '', $param));
    }
}
