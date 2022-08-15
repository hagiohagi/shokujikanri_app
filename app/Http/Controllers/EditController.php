<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealRecord;
use App\Models\MealDetail;
use App\Models\MealPhoto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class EditController extends Controller
{
    public function index(Request $request, $meal_id)
    {
        $meal_record = MealRecord::with(['mealPhotos', 'mealDetails'])->find($meal_id);
        $meal_details = $meal_record->mealDetails;
        return view('/edit', ['meal_record' => $meal_record, 'meal_details' => $meal_details]);
    }

    public function update(Request $request, $meal_id)
    {
        $meal = MealRecord::with(['mealPhotos', 'mealDetails'])->find($meal_id);

        $rules = [
            'meal_type' => ['required'],
            'eat_place' => ['required'],
            'eat_date' => ['required'],
            'eat_time' => ['required'],
            'memo' => ['max:500'],

            'food' => ['required'],
            'ingredient' => ['required'],
            'amount' => ['required'],

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

        // MealDetail::where('meal_id', $meal_id)->update([
        //     'meal_id' => $meal_id,
        //     'food' => $request['food'],
        //     'ingredient' => $request['ingredient'],
        //     'amount' => $request['amount'],
        //     'order_num' => 1,
        //     'update_user_id' => FacadesAuth::user()->id
        // ]);

        if ($request->has('files')) {

            foreach ($request->file('files') as $file) {

                do {
                    $fileName = uniqid(rand());
                } while (Storage::exists("images/$fileName"));
                $file['photo']->storeAS('images', $fileName);

                MealPhoto::create([
                    'meal_id' => $meal_id,
                    'photo_path' => $fileName,
                    'order_num' => 1,
                    'create_user_id' => FacadesAuth::user()->id,
                ]);
            }
        }

        return redirect()->route('index');
    }

    public function delete(Request $request, $meal_id)
    {

        $meal = MealRecord::find($meal_id);
        $meal->mealPhotos()->delete();
        $meal->mealDetails()->delete();
        $meal->delete();

        return redirect()->route('index');
    }

    public function photoDelete(Request $request,  $meal_id, $photo_num)
    {

        $meal = MealRecord::find($meal_id);
        $meal_photo = $meal->mealPhotos()->find($photo_num);
        $meal_photo->delete();

        return redirect()->route('edit', ['meal_id' => $meal_id]);
    }
}
