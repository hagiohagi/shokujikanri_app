<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPhoto extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'meal_photo';

    public function mealRecord()
    {
        return $this->belongsTo(MealRecord::class, 'meal_id', 'meal_id');
    }
}
