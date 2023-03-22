<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Designation
 * 
 * @property string $roles_and_designation
 *
 * @package App\Models
 */
class Designation extends Model
{
	protected $table = 'designation';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'roles_and_designation'
	];
}
