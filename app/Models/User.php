<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'jabatan',
        'avatar',
        'gaji_pokok',
        'jam_kerja',
        'jam_masuk',
        'jam_keluar',
        'is_shift',
        'shift_partner_id',
        'shift1_jam_masuk',
        'shift1_jam_keluar',
        'shift2_jam_masuk',
        'shift2_jam_keluar',
        'hari_libur',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'hari_libur' => 'array',
            'gaji_pokok' => 'decimal:2',
            'is_shift' => 'boolean',
        ];
    }

    /**
     * Get shift partner relationship.
     */
    public function shiftPartner()
    {
        return $this->belongsTo(User::class, 'shift_partner_id');
    }

    /**
     * Get users that have this user as shift partner.
     */
    public function shiftPartnerOf()
    {
        return $this->hasMany(User::class, 'shift_partner_id');
    }

    /**
     * Get the avatar URL attribute.
     */
    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/default-avatar.png');
    }
}
