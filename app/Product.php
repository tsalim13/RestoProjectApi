<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model implements HasMedia
{
    use HasMediaTrait {
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }

    public $table = 'products';

    public $fillable = [
        'name',
        'price',
        'discount_price',
        'description',
        'capacity',
        'unit',
        'deliverable',
        'category_id',
        'available'
    ];

    protected $casts = [
        'name' => 'string',
        'image' => 'string',
        'price' => 'integer',
        'discount_price' => 'integer',
        'description' => 'string',
        'capacity' => 'double',
        'unit' => 'string',
        'deliverable' => 'boolean',
        'category_id' => 'integer',
        'available' => 'boolean'
    ];

    public static $rules = [
        'name' => 'required',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id'
    ];

    protected $appends = [
        'has_media'
    ];

    public function category()
    {
        return $this->belongsTo(\App\Category::class, 'category_id', 'id');
    }

    public function options()
    {
        return $this->belongsToMany(\App\Option::class, 'product_option', 'product_id', 'option_id')
                    ->withPivot('id','option_price', 'available', 'required', 'selected', 'min_qte','max_qte', 'order')
                    ->as('option_attribute')
                    ->withTimestamps()
                    ->orderBy('product_option.order');
    }

    public function optionGroups()
    {
        return $this->belongsToMany(\App\OptionGroup::class, 'product_option_groups', 'product_id', 'option_group_id')
                    ->withPivot('id', 'min_select', 'max_select', 'order')
                    ->withTimestamps()
                    ->orderBy('product_option_groups.order');
    }

    public function getPrice(): float
    {
        return $this->discount_price > 0 ? $this->discount_price : $this->price;
    }

    /**
     * Add Media to api results
     * @return bool
     */
    public function getHasMediaAttribute()
    {
        return $this->hasMedia('image') ? true : false;
    }

    /**
     * to generate media url in case of fallback will
     * return the file type icon
     * @param string $conversion
     * @return string url
     */
    public function getFirstMediaUrl($collectionName = 'default',$conversion = '')
    {
        $url = $this->getFirstMediaUrlTrait($collectionName);
        $array = explode('.', $url);
        $extension = strtolower(end($array));
        if (in_array($extension,config('medialibrary.extensions_has_thumb'))) {
            return asset($this->getFirstMediaUrlTrait($collectionName,$conversion));
        }else{
            return asset(config('medialibrary.icons_folder').'/'.$extension.'.png');
        }
    }

    /**
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 900, 900)
            ->sharpen(10);

        $this->addMediaConversion('icon')
            ->fit(Manipulations::FIT_CROP, 100, 100)
            ->sharpen(10);
    }

}
