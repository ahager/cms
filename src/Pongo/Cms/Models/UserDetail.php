<?php namespace Pongo\Cms\Models;

use Eloquent;

class UserDetail extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_details';

	/**
	 * Timestamp needed
	 * 
	 * @var boolean
	 */
	public $timestamps = true;

	/**
	 * Guarded mass-assignment property
	 * 
	 * @var array
	 */
	protected $guarded = array('id');

	/**
	 * User relationship
	 * Each detail has one user
	 * 
	 * @return mixed
	 */
	public function user()
	{
		return $this->belongsTo('Pongo\Cms\Models\User', 'user_id');
	}

}