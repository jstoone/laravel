<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Defines the relationship between the user and all it's books.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
       return $this->hasMany(Book::class);
    }

    /**
     * Scopes the HasMany relation down to only include 5 (five) books.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function onlyFiveBooks()
    {
        return $this->books()->take(3);
    }
}
