<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendors';
    protected $fillable = [
        'name',
        'company_name',
        'document',
        'reg_state',
        'reg_municipal',
        'responsible',
        'phone',
        'email',
        'zip',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'observation'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'vendor_id', 'id');
    }
}
