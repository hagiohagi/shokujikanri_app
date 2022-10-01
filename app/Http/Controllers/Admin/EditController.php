<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MealRecord;
use App\Models\MealDetail;
use App\Models\MealPhoto;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class EditController extends Controller
{
    public function index(Request $request, $id, $meal_id)
    {
        $user = User::find($id);
        $meal_record = MealRecord::with(['mealPhotos', 'mealDetails'])->find($meal_id);
        return view('admin.edit', ['user' => $user, 'meal_record' => $meal_record]);
    }

    public function update(Request $request, $id, $meal_id)
    {
        $meal = MealRecord::find($meal_id);

        $rules = [
            'meal_type' => ['required'],
            'eat_place' => ['required'],
            'eat_date' => ['required'],
            'eat_time' => ['required'],
            'memo' => ['max:500'],

            'files.*.photo' => ['file|image|mimes:jpg,jpeg,bmp,png'],
        ];

        $this->validate($request, $rules);

        $meal->update([
            'meal_type' => $request['meal_type'],
            'eat_place' => $request['eat_place'],
            'eat_date' => $request['eat_date'],
            'eat_time' => $request['eat_time'],
            'memo' => $request['memo'],
            'update_user_id' => FacadesAuth::user()->id
        ]);

        // 食事詳細記録の既存の値更新
        //更新時は一旦消す
        MealDetail::where('meal_id', $meal_id)->delete();
        
        if ($request->meal_details) {
            foreach ($request->meal_details as $meal_detail) {
                if (!is_null($meal_detail['food']) || !is_null($meal_detail['ingredient']) || !is_null($meal_detail['amount'])) {
                    MealDetail::create([
                        'meal_id' => $meal_id,
                        'food' => $meal_detail['food'],
                        'ingredient' => $meal_detail['ingredient'],
                        'amount' => $meal_detail['amount'],
                        'order_num' => 1,
                        'create_user_id' => FacadesAuth::user()->id,
                    ]);
                }
            }
        }
        if ($request->has('files')) {

            foreach($request->file('files') as $file){

                do {
                    $fileName = uniqid(rand());
                } while(Storage::exists("images/$fileName"));
                $file['photo']->storeAS('images', $fileName); 
                
                MealPhoto::create([
                    'meal_id' => $meal_id,
                    'photo_path' => $fileName,
                    'order_num' => 1,
                    'create_user_id' => FacadesAuth::user()->id,
                ]);
            }
        }

        return redirect()->route('admin.index', ['id' => $id]);
    }

    public function delete(Request $request, $id, $meal_id) {

        $meal = MealRecord::find($meal_id);
        $meal->mealPhotos()->delete();
        $meal->mealDetails()->delete();
        $meal->delete();

        return redirect()->route('admin.index', ['id' => $id]);

    }
    public function photoDelete(Request $request, $id, $meal_id, $photo_num) {

        $meal = MealRecord::find($meal_id);
        $meal_photo = $meal->mealPhotos()->find($photo_num);
        $meal_photo->delete();

        return redirect()->route('admin.edit', ['id' => $id, 'meal_id' => $meal_id]);

    }
}
