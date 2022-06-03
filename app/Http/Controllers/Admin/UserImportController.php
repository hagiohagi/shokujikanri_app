<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\ResearchNumber;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;

class UserImportController extends Controller
{

    // const CSV_HEADER = [
    //     'name',
    //     'sex_type',
    //     'height',
    //     'weight',
    //     'fat_percentage',
    //     'sport_name',
    //     'sport_position',
    //     'email',
    //     'password',
    //     'research_number'
    // ];

    public function index(Request $request)
    {
        return view('admin.user_import');
    }

    public function upload(Request $request)
    {

        $assoc_array = [];
        if (($handle = fopen("usersCsv", "r")) !== false) {                 // open for reading
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {      // loop remaining rows of data
                $assoc_array[] = array($data);              // push associative subarrays
            }
            fclose($handle);                                               // close when done
        }

        foreach($assoc_array as $item){

            $data = [
            'name' => $item[0],
            'sex_type' =>  $item[1],
            'height' => $item[2],
            'weight' => $item[3],
            'fat_percentage' => $item[4],
            'sport_name' => $item[5],
            'sport_position' => $item[6],
            'email' => $item[7],
            'password' => $item[8],
            'auth_type' => 1,
            'research_number' => $item[9], 
            ];

            $validator = Validator::make($data,[
                'name' => ['required', 'string'],
                'sex_type' =>['required','string'],
                'height' =>['required','integer','max:999'],
                'weight' =>['required','integer','max:999'],
                'fat_percentage' =>['required','integer','max:99'],
                'sport_name' =>['required','string'],
                'sport_position' =>['string'],
                'email' => ['required', 'email'],
                'password' => ['required','confirmed', Rules\Password::defaults()],
                'research_number' => ['required', 'integer', 'digits:6', new ResearchNumber],
            ]);

            $user = new User();
            $user->fill([
                'password' =>Hash::make($item[8]),
            ])->save();
        };
    }
}
