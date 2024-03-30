<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PoliceController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|numeric|unique:users,phone',
                'email' => 'required|string|email|max:255|unique:users,email',
            ]);
            $password =12345678;

            $user = new User();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->password = Hash::make($password);
            $user->role = 'police'; // Set the role to "police"
            $user->save();

            return response()->json(['message' => 'Registration successful'], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed'], 500);
        }
    }
    
    public function index()
    {
        $police = User::where('role', 'police')->get();
        return response()->json($police);
    }
    
}
