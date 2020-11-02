<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
  public $timestamps = false;
  protected $fillale = ['artitle', 'price', 'image', 'suspensed', 'details'];
}
