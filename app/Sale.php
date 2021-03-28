<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = [];
    public $timestamps = false;

    public function customer(){
        return $this->belongsTo('\App\Customer', 'customerid');
    }

    public function details(){
        return $this->hasMany('\App\SaleDetails', 'invoicenumber');
    }
}
