<?php

namespace App\Services;

use App\Exceptions\AccommodationCommentException;
use App\Models\AccommodationComment;
use Illuminate\Support\Facades\Auth;

class UserCommentService
{
    public function getComments()
    {
        return AccommodationComment::with('accommodationUnit')
            ->where('user_id', Auth::user()->id)
            ->get();
    }

    /**
     * @throws AccommodationCommentException
     */
    public function storeComment($validated)
    {
        $validated['total_rating'] = collect($validated)->only(['location', 'service', 'price', 'facilities'])->avg();
        $validated['user_id'] = Auth::user()->id;

        $comment = AccommodationComment::create($validated);

        if ($comment) {
            return $comment;
        }

        throw new AccommodationCommentException('An error occurred while creating the comment');
    }
}
