<?php

    namespace App\Models;

    // use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class User extends Authenticatable
    {
        use HasFactory, Notifiable;

        protected $fillable = [
            'name',
            'email',
            'password',
        ];

        protected $hidden = [
            'password',
            'remember_token',
        ];

        public function articles(): HasMany
        {
            return $this->hasMany(Article::class, 'author_id');
        }

        public function hasRole($role): bool
        {
            return $this->roles->contains('name', $role);
        }

        public function hasAnyRole(array $roles)
        {
            return $this->roles()->whereIn('name', $roles)->exists();
        }

        public function roles(): BelongsToMany
        {
            return $this->belongsToMany(Role::class);
        }

        protected function casts(): array
        {
            return [
                'email_verified_at' => 'datetime',
                'password' => 'hashed',
                // 'role' => RoleType::class,
            ];
        }
    }
