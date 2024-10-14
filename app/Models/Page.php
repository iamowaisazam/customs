<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Page extends Model
{
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        "id",
        'title',
        "slug",
        "shortdetails",
        "longdetails",
        "featured",
        "meta_title",
        "meta_description",
        "meta_keywords",
        "created_at",
        "updated_at"
    ];

 
        
}