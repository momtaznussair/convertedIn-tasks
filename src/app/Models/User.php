<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    /**
     * Scope a query to only include users of a admin type.
     */
    public function scopeAdmin(Builder $query): void
    {
        $query->where('is_admin', true);
    }


     /**
     * Scope a query to only include users of a user type.
     */
    public function scopeUser(Builder $query): void
    {
        $query->where('is_admin', false);
    }

    /**
     * Get the tasks for the user.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_to_id');
    }

    /**
     * Convert the model instance to an array suitable for bulk seeding.
     *
     * @return array
     */
    public function toBulkSeedingArray()
    {
        $array = parent::toArray();

        // Include hidden attributes for seeding
        $array['password'] = $this->password;
        $array['email_verified_at'] = $this->email_verified_at;

        return $array;
    }
}
