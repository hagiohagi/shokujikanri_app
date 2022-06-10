<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\ResearchNumber;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\SurveyInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class UserImportController extends Controller
{


    public function index(Request $request)
    {
        return view('admin.user_import');
    }

    public function upload(Request $request)
    {
        // CSV読み込む
        $assoc_array = [];
        $users_csv = $request->file('usersCsv');
        if (($handle = fopen($users_csv, "r")) !== false) {                 // open for reading
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {      // loop remaining rows of data
                $assoc_array[] = array($data);              // push associative subarrays
            }
            fclose($handle);                                               // close when done
        }else{
            abort(404);
        }

        // dd($assoc_array);

        // 行の数だけユーザー登録
        foreach($assoc_array as $row){
            foreach($row as $item){

                // ユーザーデータベース用配列作る
                $user_data = [
                'name' => $item[0],
                'sex_type' => $item[1],
                'height' => $item[2],
                'weight' => $item[3],
                'fat_percentage' => $item[4],
                'sport_name' => $item[5],
                'sport_position' => $item[6],
                'email' => $item[7],
                'password' => $item[8],
                'auth_type' => 1,
                'create_user_id' => Auth::id(),
                ];

                $survey_data = [
                'research_number' => $item[9], 
                ];

                // バリデーション
                $validator = Validator::make($user_data,[
                    'name' => ['required', 'string'],
                    'sex_type' =>['required','string'],
                    'height' =>['required','integer','max:999'],
                    'weight' =>['required','integer','max:999'],
                    'fat_percentage' =>['required','integer','max:99'],
                    'sport_name' =>['required','string'],
                    'sport_position' =>['string'],
                    'email' => ['required', 'email'],
                    'password' => ['required','confirmed', Rules\Password::defaults()],
                    
                ],
                [
                    '*' => 'CSVアップロード時にエラーが発生しました'
                ]);

                $validator = Validator::make($survey_data,[
                    'research_number' => ['required', 'integer', 'digits:6', new ResearchNumber],
                ],
                [
                    '*' => 'CSVアップロード時にエラーが発生しました'
                ]);

                if ($validator->fails()) {
                    $validator->errors();
                    return redirect()->route('admin.import')->withErrors($validator)->withInput();
                 }
                // ハッシュ化
                $user_data['password'] = Hash::make($item[8]);

                // ユーザーデータベースに登録
                $user = User::create($user_data);

                $survey_info = SurveyInfo::where('research_number','=', $survey_data['research_number'])->first();
                $survey_info->users()->attach($user->id,['create_user_id' => $user->id]);

                event(new Registered($user));
                
            };
        }

        return redirect()->route('admin.user');
    }
}
