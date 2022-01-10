<?php

namespace Alegra\SDK\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlegraLog extends Model
{
	use HasFactory;

	protected $table = 'alegra_logs';
	protected $fillable = [
		'service',
		'status_code',
		'request',
		'response',
	];
}
