<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
	protected $fillable = [
		'date',
		'time_in',
		'time_out',
		'purpose',
		'visitor_id',
		'tenant_id',
		'user_id',
	];

	protected function casts(): array
	{
		return [
			'time_in' => 'datetime',
			'time_out'=> 'datetime'
		];
	}

	public function visitor(): BelongsTo
	{
		return $this->belongsTo(Visitor::class);
	}

	public function tenant(): BelongsTo
	{
		return $this->belongsTo(Tenant::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
