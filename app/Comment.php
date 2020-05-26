<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    public $fillable = ['title','comment','email','name','year','gender','zipcode','profile_id','status','recordstatus'];

}
