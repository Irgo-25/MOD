<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tindakan
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Temuan[] $temuans
 *
 * @package App\Models
 */
class Tindakan extends Model
{
	protected $table = 'tindakans';

	protected $fillable = [
		'name'
	];

	public function temuans()
	{
		return $this->hasMany(Temuan::class, 'tindakan_status_id');
	}
}
