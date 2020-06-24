<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    protected $fillable = ['role'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleted(function($role)
        {
            foreach ($role->users()->get() as $user) {
                $user->delete();
            }
        });
    }
}
