<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeRolesDesignation
 * 
 * @property int $id
 * @property string $roles_and_designation
 * @property bool $is_active
 * @property int|null $created_by
 * 
 * @property User|null $user
 * @property Collection|EmployeeOnboardingFormInput[] $employee_onboarding_form_inputs
 *
 * @package App\Models
 */
class EmployeeRolesDesignation extends Model
{
	protected $table = 'employee_roles_designation';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'bool',
		'created_by' => 'int'
	];

	protected $fillable = [
		'roles_and_designation',
		'is_active',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function employee_onboarding_form_inputs()
	{
		return $this->hasMany(EmployeeOnboardingFormInput::class, 'roles_responsible_id');
	}
}
