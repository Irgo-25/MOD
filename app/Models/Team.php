<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Team
 * 
 * @property int $id
 * @property string $tim
 * @property string $pelaksana_mod
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Temuan[] $temuans
 *
 * @package App\Models
 */
class Team extends Model
{
	protected $table = 'teams';

	protected $casts = [
		'tim' => 'array'
	];
	protected $fillable = [
		'tim',
		'pelaksana_mod'
	];

	public function temuans()
	{
		return $this->hasMany(Temuan::class);
	}
}
