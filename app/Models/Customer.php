<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'last-name',
        'email',
        'phone',
        'address',
    ];
    
    public function wallet(){
        return $this->hasOne(Wallet::class);
    }
}
