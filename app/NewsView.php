<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsView extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $table = 'news_views';
}
