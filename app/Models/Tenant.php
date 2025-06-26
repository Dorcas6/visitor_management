<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
	protected $fillable = [
		'name',
		'email',
		'phone_number',
		'apartment'
	];

	public function visits(): HasMany
	{
		return $this->hasMany(Visit::class);
	}
}
