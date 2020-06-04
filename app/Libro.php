<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libro extends Model
{
  protected $fillable = ['title', 'count', 'description'];
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  public function isbns()
  {
    return $this->hasMany(Isbn::class);
  }
}

// $libros = Libro::withTrashed()->orderBy('deleted_at','asc')->get();
