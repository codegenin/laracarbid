<?php

namespace App\Models\Auth;

use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\Models\Media;
use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Relationship\UserRelationship;

/**
 * Class User.
 */
class User extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('small')
            ->width(150)
            ->height(150)
            ->sharpen(10);

        $this->addMediaConversion('medium')
            ->width(250)
            ->height(250)
            ->sharpen(10);

        $this->addMediaConversion('large')
            ->width(500)
            ->height(500)
            ->sharpen(10);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatars')
            ->singleFile()
            ->useFallbackUrl('https://ui-avatars.com/api/?name=jl')
            ->acceptsFile(function (File $file) {
                return $file->mimeType === 'image/jpeg';
            });

        $this->addMediaCollection('vehicles')
            ->useFallbackUrl('https://ui-avatars.com/api/?name=jl')
            ->acceptsFile(function (File $file) {
                return $file->mimeType === 'image/jpeg';
            });

        $this->addMediaCollection('videos');
    }
}
