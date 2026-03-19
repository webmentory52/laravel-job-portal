<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Library\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'user_onboarding',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function candidateJobs()
    {
        return $this->hasMany(CandidateJob::class, 'user_id');
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'user_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_users', 'user_id', 'company_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function getCompany()
    {
        return $this->companies->first();
    }

    public function isAdmin()
    {
        return $this->role === UserRoleEnum::Admin->value;
    }

    public function isUser()
    {
        return $this->role === UserRoleEnum::User->value;
    }

    public function belongsToCompany(?int $companyId)
    {
        return $this->companies()->where("company_id", $companyId)->exists();
    }

    public function currentUserBelongsToCompany()
    {
        return $this->belongsToCompany($this->getCompany()?->id);
    }

    public function getRedirectUrl()
    {
        return match ($this->role) {
            UserRoleEnum::Admin->value => '/dashboard',
            UserRoleEnum::User->value => '/'
        };
    }
}
