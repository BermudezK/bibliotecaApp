<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Isbn extends Model
{
    protected $fillable = ['isbn', 'libro_id'];

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
}
