<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tenant extends Authenticatable
{
	protected $fillable = [
		'name',
		'email',
		'phone_number',
		'apartment',
		'password'
	];

	public function visits(): HasMany
	{
		return $this->hasMany(Visit::class);
	}
}
