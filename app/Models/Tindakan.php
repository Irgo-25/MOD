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
 * @property string $status
 * @property string $img_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $temuan_id
 * @property int $img_url_id
 * 
 * @property Temuan $temuan
 * @property Collection|Temuan[] $temuans
 *
 * @package App\Models
 */
class Tindakan extends Model
{
	protected $table = 'tindakans';

	protected $casts = [
		'temuan_id' => 'int',
		'img_url' => 'array',
		'pic' => 'int'
	];

	protected $fillable = [
		'status',
		'img_url',
		'temuan_id',
		'pic',
		'tanggapan_pic',
		'keterangan',
		'rencana_perbaikan',
	];


	public function temuan()
	{
		return $this->belongsTo(Temuan::class, 'temuan_id');
	}
	public function temuans()
	{
		return $this->hasMany(Temuan::class, 'tindakan_status_id');
	}
	public function departement_pic(){
		return $this->belongsTo(Departement::class, 'pic');
	}
}
