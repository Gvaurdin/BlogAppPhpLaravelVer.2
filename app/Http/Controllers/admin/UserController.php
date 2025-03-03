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

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->merge([
                'is_admin' => $request->has('is_admin'),
            ]);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'is_admin' => 'nullable|boolean',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            try {
                $user = User::create($validatedData);
            } catch (\Exception $e) {
                return redirect()->route('admin.users.create')->with('error', 'Ошибка добавления пользователя ' . $e->getMessage());
            }

            return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно добавлен');
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->isMethod('put')) {
            if ($user->name == 'Admin' || $user->id == auth()->id()) {
                $request->merge([
                    'name' => $user->name,
                    'is_admin' => $user->is_admin,
                ]);
                $message = $user->name == 'Admin' ? 'Невозможно изменить имя и роль Администратор для пользователя с именем Admin.' : 'Невозможно изменить роль Администратор для самого себя.';
                session()->flash('warning', $message);

                return redirect()->route('admin.users.edit', $user->id)->with('error', $message);
            }

            $validatedData = $request->validated();

            $validatedData['is_admin'] = $request->has('is_admin') ? true : false;

            if ($request->filled('password')) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            } else {
                unset($validatedData['password']);
            }

            try {
                $user->update($validatedData);
            } catch (\Exception $e) {
                return redirect()->route('admin.users.edit', $user->id)->with('error', 'Ошибка обновления пользователя ' . $e->getMessage());
            }

            return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно обновлен');
        }
    }

    public function delete(User $user)
    {
        if ($user->name == 'Admin' || $user->id == auth()->id()) {
            return response()->json([
                'error' => 'Невозможно удалить пользователя с именем Admin или самого себя.'
            ], 400); // Ошибка с кодом 400
        }

        try {
            $user->delete();
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ошибка удаления пользователя: ' . $e->getMessage()
            ], 500);
        }

        return response()->json([
            'success' => 'Пользователь успешно удален'
        ]);
    }

}

