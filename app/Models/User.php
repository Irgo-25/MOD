<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $jabatan
 * @property int $departement_id
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Departement $departement
 *
 * @package App\Models
 */

class User extends Authenticatable
{

	protected $table = 'users';

	protected $casts = [
		'departement_id' => 'int',
		'email_verified_at' => 'datetime',
		'role'=> 'array',
		'jabatan'=> 'array'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'jabatan',
		'role',
		'departement_id',
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function departement()
	{
		return $this->belongsTo(Departement::class, 'departement_id');
	}
}
