<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function Category()
    {
    	return $this->hasOne(Category::class,'id','category_id');
    }

    public function getTitleAttribute($value)
    {
        return mb_strtoupper($value);
    }

    public function getSubTitleAttribute($value)
    {
        return ucfirst($value);
    }
}
