<?php

    namespace App\Models;

    // use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Support\Facades\Context;

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

        public function articles(): HasMany
        {
            return $this->hasMany(Article::class, 'author_id');
        }

        public function hasRole(string $role): bool
        {

            if (Context::hasHidden('roles')) {
                return in_array(strtolower($role), Context::getHidden('roles'));
            }

            return $this->roles->contains('name', $role);
        }

        public function hasAnyRole(array $roles): bool
        {

            if (Context::hasHidden('roles')) {
                $matches = array_intersect(
                    array_map('strtolower', $roles)
                    , Context::getHidden('roles'));

                return !empty($matches);
            }

            return $this->roles()->whereIn('name', $roles)->exists();
        }

        public function roles(): BelongsToMany
        {
            return $this->belongsToMany(Role::class);
        }

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
    }
