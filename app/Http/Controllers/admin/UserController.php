<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::all()
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    public function delete(User $user)
    {
        return view('admin.users.delete', ['user' => $user]);
    }

    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $request->merge([
                'is_admin' => $request->has('is_admin'),
            ]);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'is_admin' => 'nullable|boolean',
            ]);

            // хеширование пароля перед сохранением
            $validatedData['password'] = bcrypt($validatedData['password']);


            try {
                $user = User::create($validatedData);
            }catch (\Exception $e){
                return redirect()->route('admin.users.create')->with('error', 'Ошибка добавления пользователя '
                    . $e->getMessage());
            }

            return redirect()->route('admin.users.index', $user->id)->with('success','Пользователь успешно добавлен');
        }

        if($request->isMethod('put'))
        {
            $user = User::findOrFail($request->id);

            // проверка, чтобы не изменять имя или поле is_admin у пользователя с именем "Admin" или у самого себя
            if ($user->name == 'Admin' || $user->id == auth()->id()) {
                // если имя Admin или это текущий пользователь, сбрасываем изменения
                $request->merge([
                    'name' => $user->name, // оставляем имя неизменным
                    'is_admin' => $user->is_admin, // оставляем поле is_admin неизменным
                ]);
                $message = $user->name == 'Admin' ? 'Невозможно изменить имя и роль Администратор для пользователя с именем Admin.' : 'Невозможно изменить роль Администратор для самого себя.';
                session()->flash('warning', $message);
            }
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
                'password' => 'nullable|string|min:8|confirmed',
                'is_admin' => 'nullable|boolean',
            ]);

            // проверка и хеширование пароля
            if ($request->filled('password')) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            } else {
                // если пароль не был передан, удаляем его из массива данных
                unset($validatedData['password']);
            }


            try {
                $user = User::query()->find($request->id);
                $user->update($validatedData);
            }catch (\Exception $e){
                return redirect()->route('admin.users.edit')->with('error', 'Ошибка обновления пользователя '
                    . $e->getMessage());
            }
            return redirect()->route('admin.users.index',$user->id)->with('success','Пользователь успешно обновлен');
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Ошибка удаления пользователя ' . $e->getMessage());
        }

        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно удален');
    }
}

