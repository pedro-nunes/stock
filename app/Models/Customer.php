<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'first_name',
        'last_name',
        'register',
        'document',
        'whatsapp',
        'phone',
        'email',
        'where_find',
        'zip',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state'
    ];

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = Str::title($value);
    }
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = Str::title($value);
    }

    public function setDocumentAttribute($value)
    {
        $this->attributes['document'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function setRegisterAttribute($value)
    {
        $this->attributes['register'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function setWhatsappAttribute($value)
    {
        $this->attributes['whatsapp'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function setZipAttribute($value)
    {
        $this->attributes['zip'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function getDocumentAttribute($value)
    {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $value);
    }

    public function getWhatsappAttribute($value)
    {
        return preg_replace("/(\d{2})(\d{4,5})(\d{4})/", "\$1 \$2-\$3", $value);
    }
    public function getPhoneAttribute($value)
    {
        return preg_replace("/(\d{2})(\d{4,5})(\d{4})/", "\$1 \$2-\$3", $value);
    }
    public function getZipAttribute($value)
    {
        return preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $value);
    }

}
