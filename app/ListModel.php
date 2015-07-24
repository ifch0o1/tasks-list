<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListModel extends Model
{
	use SoftDeletes;

	/**
	* Column used for soft deletes
	*
	* @var array
	*/
	protected $dates = ['deleted_at'];

	/**
	* The table used by this model
	*
	* @var string
	*/
	protected $table = 'lists';

	/**
	* List model belongs to an user
	*
	* @return Model App\User
	*/
	public function user() {
		return $this->belongsTo('\App\User', 'list_id');
	}

    /**
    * One to many relation with Tasks
    *
    * @return Collection
    */
	public function tasks() {
		return $this->hasMany('App\Task', 'list_id');
	}
}
