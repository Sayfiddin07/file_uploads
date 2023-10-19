<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path'
    ];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_files');
    }

    public function scopeInitQuery(Builder $query):Builder
    {
        $user= auth()->user();

        if($user->hasRole('user')){
            return $query->whereHas('users', function (Builder $q) {
                return $q->where('id', '=', auth()->id());
            });
        }
            return $query;
      
    }


}
