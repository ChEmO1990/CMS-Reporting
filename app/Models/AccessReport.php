<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessReport extends Model
{
	protected $primaryKey = 'access_id';
	
	protected $fillable = [ 'access_id', 'role_id', 'report_id' ];
	protected $table = 'access_reports';
}
