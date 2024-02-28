<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Departement
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Temuan[] $temuans
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Departement extends Model
{
	protected $table = 'departements';

	protected $fillable = [
		'name'
	];

	public function temuans()
	{
		return $this->hasMany(Temuan::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
