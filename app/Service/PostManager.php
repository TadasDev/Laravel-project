<?php

namespace App\Service;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostManager
{
    /**
     * @param User $user
     * @param array $data
     *
     * @return Post|\Illuminate\Database\Eloquent\Model
     * @throws ValidationException
     */
    public function create(User $user, array $data)
    {
        $dateEnd = now()->addDays(60)->format('Y-m-d');

        Validator::make($data, [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:4800'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999'],
            'category_id' => ['required', 'exists:categories,id'],
            'expires_at' => ['required', 'date_format:Y-m-d', 'after:today', sprintf('before_or_equal: %s', $dateEnd)],
        ])->validate();

        return $user->posts()->create($data);
    }
}
