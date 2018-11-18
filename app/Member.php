<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $fillable = ['alias', 'is_private', 'user_id'];


    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
