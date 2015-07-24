<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    /**
    * Column for soft deletes date.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

	public function listModel() {
		return $this->belongsTo('App\ListModel', 'list_id');
	}
}
