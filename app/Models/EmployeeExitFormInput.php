<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeExitFormInput
 * 
 * @property int $id
 * @property string|null $employee_id
 * @property string|null $employee_name
 * @property Carbon|null $resignation_date
 * @property int|null $reason_for_resignation
 * @property Carbon|null $separation_date
 * @property string|null $clearance_received
 * @property string|null $revoked_accesses
 * @property int|null $maker_id
 * @property int|null $checker_id
 * @property int|null $approver_id
 * @property Carbon|null $added_time
 * @property int|null $form_id
 * @property int|null $form_input_status_id
 * @property int|null $form_status_id
 * @property int|null $workflow_status_id
 * @property string|null $file_name
 * @property string|null $file_orginal_name
 *
 * @package App\Models
 */
class EmployeeExitFormInput extends Model
{
	protected $table = 'employee_exit_form_inputs';
	public $timestamps = false;

	protected $casts = [
		'resignation_date' => 'date',
		'reason_for_resignation' => 'int',
		'separation_date' => 'date',
		'maker_id' => 'int',
		'checker_id' => 'int',
		'approver_id' => 'int',
		'added_time' => 'date',
		'form_id' => 'int',
		'form_input_status_id' => 'int',
		'form_status_id' => 'int',
		'workflow_status_id' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'employee_name',
		'resignation_date',
		'reason_for_resignation',
		'separation_date',
		'clearance_received',
		'revoked_accesses',
		'maker_id',
		'checker_id',
		'approver_id',
		'added_time',
		'form_id',
		'form_input_status_id',
		'form_status_id',
		'workflow_status_id',
		'file_name',
		'file_orginal_name'
	];
}
