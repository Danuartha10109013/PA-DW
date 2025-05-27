<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function absents(): HasMany
    {
        return $this->hasMany(Absent::class, 'user_id', 'id');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class, 'user_id', 'id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    // get count cuti per tahun
    public static function countCutiPerTahun($userId,$tahun)
    {
        return Submission::where('user_id', $userId)
            ->where('type', 'cuti')
            ->where('status', 'Disetujui')
            ->whereYear('start_date', $tahun)
            ->sum('total_day');
    }

    // public static function countCutiPerTahun($tahun)
    // {
    //     return Submission::where('user_id', Auth::user()->id)
    //         ->where('type', 'cuti')
    //         ->whereYear('start_date', $tahun)
    //         ->count();
    // }
}
