<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealRecord extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'meal_record';
    protected $primaryKey = 'meal_id';


    protected $fillable = [
        'user_id',
        'meal_type',
        'eat_place',
        'eat_date',
        'eat_time',
        'memo',
        'create_user_id',
        'update_user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mealDetails()
    {
        return $this->hasMany(MealDetail::class, 'meal_id', 'meal_id');
    }

    public function mealPhotos()
    {
        return $this->hasMany(MealPhoto::class, 'meal_id', 'meal_id');
    }
}
