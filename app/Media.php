<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as BaseMedia;


class Media extends BaseMedia implements HasMedia
{
    use HasMediaTrait{
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }

    protected $appends = [
        'url',
        'thumb',
        'icon',
        'formated_size'
    ];

    /**
     * to generate media url in case of fallback will
     * return the file type icon
     * @param string $conversion
     * @return string url
     */
    public function getFirstMediaUrl($conversion = '')
    {
        $url = $this->getUrl();
        $array = explode('.', $url);
        $extension = strtolower(end($array));
        if (in_array($extension,config('medialibrary.extensions_has_thumb'))) {
            return asset($this->getUrl($conversion));
        }else{
            return asset(config('medialibrary.icons_folder').'/'.$extension.'.png');
        }
    }

    public function getUrlAttribute()
    {
        return $this->getFullUrl();
    }

    public function getThumbAttribute()
    {
        return $this->getFirstMediaUrl('thumb');
    }

    public function getIconAttribute()
    {
        return $this->getFirstMediaUrl('icon');
    }

    public function getFormatedSizeAttribute()
    {
        return $this->formatedSize($this->size);
    }

    function formatedSize($bytes, $precision = 1)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}