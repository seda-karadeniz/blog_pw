<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property \Illuminate\Support\Carbon $published_at
 * @property string $excerpt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $category_id
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 */
class Post extends Model
{
    protected $dates = [
        'published_at'
    ];
    //protected $guarded = [];
    /*protected $fillable = [
        'title',
        'body',
        'slug',
        'excerpt'
    ];*/
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }






    public function scopeFilter($query, array $filters){
        $query->when( $filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query)=>
                $query->where('title','like','%' . $search .'%')
                    ->orWhere('excerpt','like','%' . $search.'%')
                    ->orWhere('body','like','%' . $search.'%'))

        );
        $query->when( $filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn($query)=>
                $query->where('slug',$category))

        );
        $query->when( $filters['user'] ?? false, fn($query, $user) =>
            $query->whereHas('user', fn($query)=>
                $query->where('username',$user))

        );



    }

   /* public function author(){
        return $this->belongsTo(User::class, 'user_id');
   //preciser que author refernce le user id
    }*/
    use HasFactory;
}
