<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Isbn extends Model
{
    protected $fillable = ['isbn', 'libro_id','state'];

    public function libro()
    {
        return $this->belongsTo(Libro::class)->withTrashed();
    }

    public function borrows(){
        return $this->hasMany(Borrow::class);
    }
}
