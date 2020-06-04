<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
  protected $fillable = ['title', 'count', 'description'];
}
