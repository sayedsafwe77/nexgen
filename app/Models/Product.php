<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Spatie\MediaLibrary\HasMedia;
use App\Support\Traits\Selectable;
use App\Http\Filters\ProductFilter;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements HasMedia, TranslatableContract
{
    use HasFactory;
    use Translatable;
    use InteractsWithMedia;
    use HasUploader;
    use Filterable;
    use Selectable;
    use SoftDeletes;

    /**
     * The translated attributes that are mass assignable.
     *
     * @var array
     */
    public $translatedAttributes = ['name', 'description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'translations',
        'media',
        'category',
    ];

    /**
     * The query parameter's filter of the model.
     *
     * @var string
     */
    protected $filter = ProductFilter::class;

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default');
        $this
            ->addMediaCollection('product_images');
        //->useFallbackUrl('/url/to/default')
        //->singleFile()

    }
    public function qutation()
    {
        return $this->belongsToMany(Qutation::class, 'product_qutations');
    }
    public function productQutation()
    {
        return $this->hasOne(ProductQutation::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
