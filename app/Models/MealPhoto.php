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
    protected $primaryKey = 'photo_num';
    protected $guarded = ['meal_id'];
    

    protected $fillable = [
        'photo_path',
        'order_num',
    ];

    public function mealRecord()
    {
        return $this->belongsTo(MealRecord::class, 'meal_id', 'meal_id');
    }
}
