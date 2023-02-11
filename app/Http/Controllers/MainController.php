<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function save(Request $request) {

        // Validate requests Валидация данных формы

        $request->validate([
            'name' => 'required', // поле name  обязательно
            'email' => 'required|email|unique:auths', // поле email обязательно и уникально
            'password' => 'required|min:5|max:12' // поле password  обязательно, и не меньше 5 символов, но не больше 12
        ]);

        // insert data into database

        $auth = new Auth;  // Создаем экзепляр модели где хранятся пользователи
        $auth->name = $request->name; // из запроса формы вытягиваем имя и записываем в таблицу в соответствующее поле
        $auth->email = $request->email; // из запроса формы вытягиваем имя и записываем в таблицу в соответствующее поле
        $auth->password = Hash::make($request->password); // из запроса формы вытягиваем имя и записываем в таблицу в соответствующее поле
        $save = $auth->save(); // сохраняем в базу результаты


        // Если сохранение в базу произошло успешно, то выводим соотв. сообщение
        if ($save) {
            return back()->with('success', 'Новый пользователь успешно зарегистрирован');
        }else {
            // иначе выводим текст с ошибкой!
            return back()->with('fail', "Что-то пошло не так");
        }
    }

    public function check (Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        $userInfo = Auth::where('email', '=', $request->email)->first();
       //$userInfo = DB::table('auths')->where('email', '=', $request->email)->first();

       if (!$userInfo) {
           return back()->with('fail', 'We do not recognize your email address');
       } else {
           // Проверка пароля
           if (Hash::check($request->password, $userInfo->password)) {
               $request->session()->put('LoggedUser', $userInfo->id); // сохраанение пользователя в сессию по id
               return redirect('admin/dashboard');
           } else {
               return back()->with('fail', 'Incorrect password');
           }
       }
    }

    public function logout() {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('auth/login');
        }
    }

    public function  dashboard() {
        $data = ['LoggedUserInfo' => Auth::where('id', '=', session('LoggedUser'))->first()];
        return view('admin.dashboard', $data);
    }
}
