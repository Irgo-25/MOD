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
 * @property int $pj_id
 * @property string $tim
 * @property string $usulan
 * @property string $tanggapan_pj
 * @property int $departement_id
 * @property Carbon $jadwal_penyelesaian
 * @property Carbon $rencana_perbaikan
 * @property int $tindakan_status_id
 * @property int $tindakan_img_url_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Departement $departement
 * @property Team $team
//  * @property PenanggungJawab $penanggung_jawab
 * @property Tindakan $tindakan
 * @property Collection|Tindakan[] $tindakans
 *
 * @package App\Models
 */
class Temuan extends Model
{
	protected $table = 'temuans';

	protected $casts = [
		// 'pj_id' => 'int',
		'tindakan_status_id' => 'int',
		'tindakan_img_url_id' => 'int',
		'img_url' => 'array',
		'pelaksana_mod' => 'array',
	];

	protected $fillable = [
		'tim',
		'pelaksana_mod',
		'deskripsi_temuan',
		'pic',
		'lokasi',
		'img_url',
		'usulan',
		'tindakan_status_id',
		'tindakan_img_url_id'
	];

	public function team()
	{
		return $this->belongsTo(Team::class, 'pelaksana_mod');
	}
	public function departement_pic()
	{
		return $this->belongsTo(Departement::class, 'pic');
	}
	public function tindakans()
	{
		return $this->hasMany(Tindakan::class, 'temuan_id');
	}
	public function tindakan()
	{
		return $this->belongsTo(Tindakan::class, 'tindakan_status_id');
	}
}
