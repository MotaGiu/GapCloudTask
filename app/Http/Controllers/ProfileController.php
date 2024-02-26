<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:200',
        ]);

        $user = Auth::user();
        $profilePicture = $request->file('profile_picture');
        $profilePictureName = time().'.'.$profilePicture->getClientOriginalExtension();

        // Delete the old profile picture if it exists and store the new one
        Storage::delete('public/profile_pictures/'.$user->profile_picture);
        $path = $profilePicture->storeAs('public/profile_pictures', $profilePictureName);

        // Update the user's profile picture in the database
        $user->profile_picture = $profilePictureName;
        $user->save();

        return back()->with('success', 'Your profile picture has been updated successfully.');
    }
}
