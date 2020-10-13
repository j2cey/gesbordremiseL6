<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App
 *
 * @property integer $id
 *
 * @property string $name
 * @property string $username
 * @property string $email
 * @property Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 *
 * @property string $image
 * @property bool $is_local
 * @property bool $is_ldap
 * @property integer|null $ldap_account_id
 * @property string|null $objectguid
 * @property integer|null $status_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    #region Eloquent Relationships

    public function status() {
        return $this->belongsTo('App\Status');
    }

    /**
     * Renvoie le Compte LDAP du User.
     */
    public function ldapaccount() {
        return $this->belongsTo('App\LdapAccount', 'ldap_account_id');
    }


    #endregion

    public function isActive() {
        return $this->status->id === Status::active()->first()->id;
    }

    private function setUsername() {
        if (empty($this->username)) {
            $this->username = explode('@', $this->email)[0];
        }
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->setUsername();
        });

        self::created(function($model){
            // ... code here
        });

        self::updating(function($model){
            $model->setUsername();
        });

        self::updated(function($model){
            // ... code here
        });

        self::deleting(function($model){
            // ... code here
        });

        self::deleted(function($model){
            // ... code here
        });
    }
}

