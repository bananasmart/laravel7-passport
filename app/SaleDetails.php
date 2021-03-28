<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{   
    protected $table = 'sales_details';
    protected $fillable = [];
    public $timestamps = false;

    public function sale(){
        return $this->belongsTo('\App\Sale', 'invoicenumber');
    }


}
