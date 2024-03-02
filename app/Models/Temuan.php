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
 * @property PenanggungJawab $penanggung_jawab
 * @property Tindakan $tindakan
 * @property Collection|Tindakan[] $tindakans
 *
 * @package App\Models
 */
class Temuan extends Model
{
	protected $table = 'temuans';

	protected $casts = [
		'pj_id' => 'int',
		'departement_id' => 'int',
		'jadwal_penyelesaian' => 'datetime',
		'rencana_perbaikan' => 'datetime',
		'tindakan_status_id' => 'int',
		'tindakan_img_url_id' => 'int',
		'img_url' => 'array',
	];

	protected $fillable = [
		'deskripsi_temuan',
		'lokasi',
		'img_url',
		'pj_id',
		'tim',
		'usulan',
		'tanggapan_pj',
		'departement_id',
		'jadwal_penyelesaian',
		'rencana_perbaikan',
		'tindakan_status_id',
		'tindakan_img_url_id'
	];

	public function departement()
	{
		return $this->belongsTo(Departement::class);
	}

	public function penanggung_jawab()
	{
		return $this->belongsTo(PenanggungJawab::class, 'pj_id');
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
