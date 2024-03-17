<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Questions;
use App\Http\Traits\GeneralTraits;
use Illuminate\Support\Facades;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    use GeneralTraits;

    public function __construct()
    {
        //
    }
    public function login (Request $request)
    {
         //$uri = $request->path();
         $email = $request->email ;
         $passwordHash = $request->passwordHash ;

        $user = User::where('email', $request->email)->first();
        if ($user)
        {
            if (Hash::check($request->passwordHash, $user->passwordHash))
            //if ($request->password ==  $user->password)
            {
                if($user->ban==1)
                {
                    return $this->returnError('406', __('messages.this user is banned call admin support'));
                }
                    $user->remember_token = Str::random(25);
                    $user->save();
                    return $this->customreturnData('data','user' ,$user  , __('messages.logged in  done data retrieved') );
            }
            else
            {
                return $this->returnError('412',__('messages.password missmatch'));
            }
        } else
        {
            return $this->returnError('408', __('messages.user doesnt existes'));
        }

    }

    public function banIP(Request $request)
    {

        $user_code = $request->user_code;
        $user = User::where('user_code', $user_code)->first();
        if ($user)
        {
            User::where('user_code',$user_code)->update(['ban'=>'1']);
            return $this->customreturnData('data','user' ,$user  , __('messages.user Banned') );
        }
        else
        {
            return $this->returnError('408', __('messages.user doesnt existes'));
        }

    }

    public function getQuestions()
    {


        //check user already logged or not by middleware
        //if not loged go out
        $questions =Questions::select('id','content')->get();
        $questions = json_encode($questions, JSON_UNESCAPED_UNICODE);
        //$questions = Questions::all();
        return $this->customreturnData('data','questions' ,$questions  , __('messages.questions retrieved ') );

        //else show questions
    }
    public function show($id)
    {
        return User::findOrFail($id);
    }

}
