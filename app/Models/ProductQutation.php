<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQutation extends Model
{
    use HasFactory;
    protected $table = 'product_qutations';
    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
    public function qutations()
    {
        return $this->belongsToMany(Qutation::class);
    }
}
