<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $primaryKey = 'report_id';
	
	protected $fillable = [ 'report_id', 'report_name', 'report_url', 'departament' ];
	protected $table = 'reports';
}
