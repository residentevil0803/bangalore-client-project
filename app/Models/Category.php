<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * The attributes that must be protected from mass assignment.
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Scope a query to only include root Categories.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeRoot($query)
    {
        return $query->where('parent_id', 0);
    }


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}