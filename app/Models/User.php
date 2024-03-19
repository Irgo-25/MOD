<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

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
	use HasApiTokens, HasFactory, Notifiable, HasRoles;
	protected $table = 'users';

	protected $casts = [
		'departement_id' => 'int',
		'email_verified_at' => 'datetime',
		'role' => 'string'
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
