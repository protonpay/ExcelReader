<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeAccess
 * 
 * @property int $id
 * @property string $access
 * @property bool|null $is_active
 *
 * @package App\Models
 */
class EmployeeAccess extends Model
{
	protected $table = 'employee_accesses';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'access',
		'is_active'
	];
}
