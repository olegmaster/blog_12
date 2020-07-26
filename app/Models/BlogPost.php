<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class BlogPost
 * @package App\Models
 */
class BlogPost extends Model
{
    use SoftDeletes;

    /**
     * Blog Categories
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {   
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Post Author
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
