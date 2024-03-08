<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Temuan
 * 
 * @property int $id
 * @property string $deskripsi_temuan
 * @property string $lokasi
 * @property string $img_url
 * @property int $pelaksana_mod
 * @property string $tim
 * @property string $usulan
 * @property int $pic
 * @property int|null $tindakan_status_id
 * @property int|null $tindakan_img_url_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Team $team
 * @property Departement $departement
 * @property Tindakan|null $tindakan
 * @property Collection|Tindakan[] $tindakans
 *
 * @package App\Models
 */
class Temuan extends Model
{
	protected $table = 'temuans';

	protected $casts = [
		'pic' => 'int',
		'tim_id' => 'int',
		'tindakan_status_id' => 'int',
		'tindakan_img_url_id' => 'int',
		'img_url' => 'array',
		'pelaksana_mod' =>'string'
	];

	protected $fillable = [
		'deskripsi_temuan',
		'lokasi',
		'img_url',
		'pelaksana_mod',
		'tim_id',
		'usulan',
		'pic',
		'tindakan_status_id',
		'tindakan_img_url_id'
	];

	public function team()
	{
		return $this->belongsTo(Team::class, 'tim_id');
	}

	public function departement_pic()
	{
		return $this->belongsTo(Departement::class, 'pic');
	}

	public function tindakan()
	{
		return $this->belongsTo(Tindakan::class, 'tindakan_status_id');
	}

	public function tindakans()
	{
		return $this->hasMany(Tindakan::class);
	}
}
