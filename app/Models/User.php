<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // 定義關聯
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // 定義新關聯
    public function tasksSummary($period = null)
    {
        [$start, $end] = match ($period) {
            'today' => [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()],
            'yesterday' => [Carbon::yesterday()->startOfDay(), Carbon::yesterday()->endOfDay()],
            'lastweek', 'last-week' => [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()],
            'thismonth', 'this-month' => [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()],
            'lastmonth', 'last-month' => [Carbon::now()->startOfMonth()->subMonthsNoOverflow(), Carbon::now()->subMonthsNoOverflow()->endOfMonth()],
            default => [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()],
        };

        // 取得目前使用者的所有目錄
        return $this->tasks()
                    ->whereBetween('created_at', [$start, $end])
                    ->latest()
                    ->get();
    }
}
