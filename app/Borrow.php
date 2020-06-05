<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    protected $fillable = ['user_id', 'isbn_id'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongTo(User::class);
    }


    public function isbn()
    {
        return $this->belongTo(Isbn::class);
    }
}
