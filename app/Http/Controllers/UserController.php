<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{

    public function profile($name){
        $user = User::where('name', '=', $name) -> firstOrFail();
        return view('users.profile', compact('user'));
    }

     public function showProfile($id)
    {
        $user = User::findOrFail($id);
        return view('profile', compact('user'));
    }

 // Handle the profile update
   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validate input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'birthday' => 'nullable|date',
        'about' => 'nullable|string',
    ]);

    // Update user details
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->birthday = $request->input('birthday');
    $user->about = $request->input('about');
    $user->save();

    // Redirect back to the profile page
    return redirect()->route('profile', $user->name)->with('success', 'Profile updated successfully');
}

    public function promoteToAdmin($id){
        // Check if the current user is authorized to perform this action
        if (Auth::user() -> is_admin) {
            $user = User::findOrFail($id);
            $user->is_admin = true; // Set user as admin
            $user->save();

            return redirect()->route('profile', $user->name)->with('success', 'User promoted to admin successfully.');
        } else {
            abort(403, 'Alleen admins kunnen andere promoten.');
        }
    }

public function uploadAvatar(Request $request)
{
    // Validate the uploaded file
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
    ]);

    // Store the uploaded file in storage/app/public/avatars
    $path = $request->file('avatar')->store('public/avatars');

    // Update the user's avatar field in the database
    $user = Auth::user();
    $user->avatar = basename($path); // Store only the filename in the database
    $user->save();

    return back()->with('success', 'Avatar uploaded successfully.');
}

    
}


    
