<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Service;

class Comment extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }// end of relation

    public function service()
    {
        return $this->belongsTo(Service::class);
    }// end of relation
}
