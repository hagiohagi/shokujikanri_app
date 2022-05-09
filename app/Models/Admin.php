<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $connection = 'sqlite';
    
    protected $fillable = [
        'name',
        'sex_type',
        'height',
        'weight',
        'fat_percentage',
        'sport_name',
        'sport_position',
        'auth_type',
        'email',
        'password',
        'create_user_id',
        'update_user_id',
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
    ];

    public function mealrecords()
    {
        return $this->hasMany(MealRecord::class, 'user_id');
    }

    public function surveyInfos()
    {
        return $this->belongsToMany(SurveyInfo::class, 'user_survey_mapping');
    }
}
