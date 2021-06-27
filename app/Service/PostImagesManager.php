<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostImagesManager
{
    /**
     * @param Post $post
     * @param array $images
     *
     * @throws ValidationException
     */
    public function appendToPost(Post $post, array $images): void
    {
        Validator::make(['images' => $images], [
            'images.*' => 'mimes:jpg,jpeg,png|max:400',
            'images' => 'max:5',
        ], [
            'images.max' => 'Cannot upload more than 5 files',
        ])->validate();

        foreach ($images as $image) {
            $path = $image->storePublicly('images', 'public');
            $post->images()->create([
                'file_path' => $path
            ]);
        }
    }
}
