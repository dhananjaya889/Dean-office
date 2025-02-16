<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'dob',
        'phone_number',
        'whatsapp',
        'nic',
        'address_l1',
        'address_l2',
        'city',
        'province',
        'postal_code',
        'role',
        'start_date',
        'gender',
        'married',
        'experience',
        'reg_no',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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
     * Update the profile photo for the user.
     *
     * @param  mixed  $photo
     * @return void
     */
    public function updateProfilePhoto($photo)
{
    // Check if the user already has a profile photo and delete it if necessary
    if ($this->profile_photo_path) {
        Storage::delete($this->profile_photo_path);
    }

    // Store the new photo in the 'profile-photos' directory within 'public' disk
    $path = $photo->store('profile-photos', 'public');

    // Update the user's profile photo path in the database
    $this->update(['profile_photo_path' => $path]);
}
}
