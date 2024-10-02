<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'no_kp',
        'email',
        'password',
        'email_verified_at',
        'tahap_pengguna',
        'gambar_profil',
        'status',
        'acc_status',
        'last_active_at',
    ];

    public function username()
    {
        return 'no_kp';
    }

    public function program()
    {
        return $this->hasMany(Program::class);
    }

    public function programKehadiran()
    {
        return $this->hasMany(ProgramKehadiran::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'users_id');
    }

    // public function klien()
    // {
    //     return $this->hasOne(Klien::class, 'users_id');
    // }
}
