<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeResignationReason
 * 
 * @property int $id
 * @property bool $is_active
 * @property string $reason
 *
 * @package App\Models
 */
class EmployeeResignationReason extends Model
{
	protected $table = 'employee_resignation_reasons';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'is_active',
		'reason'
	];
}
