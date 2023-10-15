<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Support\Traits\Selectable;
use App\Http\Filters\QutationFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Qutation extends Model
{
    use HasFactory;
    use Filterable;
    use Selectable;
    use SoftDeletes;
    // protected $entity_types = [
    //     'User' => Customer::class,
    // ];

    public function qutationable()
    {
        return $this->morphTo();
    }
    /**
     * The query parameter's filter of the model.
     *
     * @var string
     */
    protected $filter = QutationFilter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sub_total',
        'total',
        'category_id',
        'installation_fees',
        'qutationable_id',
        'qutationable_type',
        'discount'
    ];

    // public function getEntityTypeAttribute($type)
    // {
    //     if ($type === null) {
    //         return null;
    //     }

    //     $type = strtolower($type);
    //     return array_get($this->entity_types, $type, $type);
    // }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_qutations')->withPivot('quantity');
    }
    public function productQutation()
    {
        return $this->hasMany(ProductQutation::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'qutationable_id');
    }
}
