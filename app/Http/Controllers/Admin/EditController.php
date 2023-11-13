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
            'files.*.photo' => ['image','mimes:jpg,jpeg,bmp,png'],
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

        //更新時は一旦消す
        MealDetail::where('meal_id',$meal_id)->delete();

        // laravelによる既存の値更新
        if ($request->meal_details) {
            foreach ($request->meal_details as $meal_detail) {
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
        // vue側による新規の値登録
        if ($request->mealDetails) {
            foreach ($request->mealDetails as $new_detail) {
                MealDetail::create([
                    'meal_id' => $meal_id,
                    'food' => $new_detail['food'],
                    'ingredient' => $new_detail['ingredient'],
                    'amount' => $new_detail['amount'],
                    'order_num' => 1,
                    'update_user_id' => FacadesAuth::user()->id
                ]);
            }
        }


        if ($request->has('files')) {

            foreach($request->file('files') as $file){
                do {
                    // 拡張子を取得
                    $extension = $file['photo']->getClientOriginalExtension();
                    // 一意なファイル名を生成 (例: 20230101-123456.jpg)
                    $fileName = date('Ymd-His') . '-' . uniqid() . '.' . $extension;
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

        return redirect()->route('admin.index', ['id' => $id]);
    }

    public function delete(Request $request, $id, $meal_id) {

        $meal = MealRecord::find($meal_id);
        // 関連する写真データを取得して、それらのファイルを削除
        foreach ($meal->mealPhotos as $mealPhoto) {
            $path = 'images/' . $mealPhoto->photo_path;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
        $meal->mealPhotos()->delete();
        $meal->mealDetails()->delete();
        $meal->delete();

        return redirect()->route('admin.index', ['id' => $id]);

    }
    public function photoDelete(Request $request, $id, $meal_id, $photo_num) {

        $meal = MealRecord::find($meal_id);
        $meal_photo = $meal->mealPhotos()->find($photo_num);
        $path = 'images/' . $meal_photo->photo_path;
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
        $meal_photo->delete();

        return redirect()->route('admin.edit', ['id' => $id, 'meal_id' => $meal_id]);

    }
}
