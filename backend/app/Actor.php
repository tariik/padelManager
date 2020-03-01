<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Actor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cast_id',
        'character',
        'credit_id',
        'gender',
        'id',
        'name',
        'order',
        'profile_path',
    ];
}