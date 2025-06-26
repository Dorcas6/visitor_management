<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visitor extends Model
{
	protected $fillable = [
		'last_name',
		'first_name',
		'phone_number',
		'icn'
	];

	public function visits(): HasMany
	{
		return $this->hasMany(Visit::class);
	}
}
