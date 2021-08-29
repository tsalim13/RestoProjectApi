<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Option extends Model implements HasMedia
{
    use HasMediaTrait {
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }

    public $table = 'options';

    public $fillable = [
        'name',
        'description',
        //'price',
        'option_group_id',
        'available'
    ];

    protected $casts = [
        'name' => 'string',
        'image' => 'string',
        'description' => 'string',
        //'price' => 'double',
        'option_group_id' => 'integer',
        'available' => 'boolean'
    ];

    public static $rules = [
        'name' => 'required',
        //'price' => 'nullable|numeric|min:0',
        'option_group_id' => 'required|exists:option_groups,id'
    ];

    protected $appends = [
        'has_media'
    ];

    public function products()
    {
        return $this->belongsToMany(\App\Product::class, 'product_option', 'option_id', 'product_id')
                    ->withPivot('option_price', 'available', 'required', 'min_qte','max_qte')
                    ->withTimestamps();
    }

    public function optionGroup()
    {
        return $this->belongsTo(\App\OptionGroup::class, 'option_group_id', 'id');
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
            ->fit(Manipulations::FIT_CROP, 500, 500)
            ->sharpen(10);

        $this->addMediaConversion('icon')
            ->fit(Manipulations::FIT_CROP, 100, 100)
            ->sharpen(10);
    }

}
