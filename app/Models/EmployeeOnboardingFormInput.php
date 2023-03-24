<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeOnboardingFormInput
 * 
 * @property int $id
 * @property int|null $workflow_status_id
 * @property int|null $roles_responsible_id
 * @property int|null $assigned_to_client_id
 * @property string|null $employee_name
 * @property string|null $employee_id
 * @property Carbon|null $date_of_joining
 * @property Carbon|null $contract_start
 * @property Carbon|null $contract_end
 * @property string|null $file_name
 * @property string|null $file_orginal_name
 * @property Carbon|null $added_time
 * @property string|null $bgv_completed
 * @property int|null $maker_id
 * @property int|null $checker_id
 * @property int|null $approver_id
 * @property int|null $form_id
 * @property int|null $form_status_id
 * @property int|null $form_input_status_id
 * 
 * @property EmployeeOnboardingClient|null $employee_onboarding_client
 * @property Form|null $form
 * @property User|null $user
 * @property WorkflowStatus|null $workflow_status
 * @property EmployeeRolesDesignation|null $employee_roles_designation
 * @property FormInputStatus|null $form_input_status
 * @property FormStatus|null $form_status
 *
 * @package App\Models
 */
class EmployeeOnboardingFormInput extends Model
{
	protected $table = 'employee_onboarding_form_input';
	public $timestamps = false;

	protected $casts = [
		'workflow_status_id' => 'int',
		'roles_responsible_id' => 'int',
		'assigned_to_client_id' => 'int',
		'date_of_joining' => 'date',
		'contract_start' => 'date',
		'contract_end' => 'date',
		'added_time' => 'date',
		'maker_id' => 'int',
		'checker_id' => 'int',
		'approver_id' => 'int',
		'form_id' => 'int',
		'form_status_id' => 'int',
		'form_input_status_id' => 'int'
	];

	protected $fillable = [
		'workflow_status_id',
		'roles_responsible_id',
		'assigned_to_client_id',
		'employee_name',
		'employee_id',
		'date_of_joining',
		'contract_start',
		'contract_end',
		'file_name',
		'file_orginal_name',
		'added_time',
		'bgv_completed',
		'maker_id',
		'checker_id',
		'approver_id',
		'form_id',
		'form_status_id',
		'form_input_status_id'
	];

	public function employee_onboarding_client()
	{
		return $this->belongsTo(EmployeeOnboardingClient::class, 'assigned_to_client_id');
	}

	public function form()
	{
		return $this->belongsTo(Form::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'approver_id');
	}

	public function workflow_status()
	{
		return $this->belongsTo(WorkflowStatus::class);
	}

	public function employee_roles_designation()
	{
		return $this->belongsTo(EmployeeRolesDesignation::class, 'roles_responsible_id');
	}

	public function form_input_status()
	{
		return $this->belongsTo(FormInputStatus::class);
	}

	public function form_status()
	{
		return $this->belongsTo(FormStatus::class);
	}
}
