<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    
    protected $guarded = [''];

    public function billing_details(){
        return $this->hasMany(BillingDetail::class);
    }

}
