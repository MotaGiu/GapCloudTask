<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Services\UserService;
use App\Rules\Captcha;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Illuminate\Support\Facades\Storage;

/**
 * Class RegisterController.
 */
class RegisterController
{
    use RegistersUsers;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function redirectPath()
    {
        return route(homeRoute());
    }

    public function showRegistrationForm()
    {
        abort_unless(config('boilerplate.access.user.registration'), 404);
        return view('frontend.auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'password' => array_merge(['max:100'], PasswordRules::register($data['email'] ?? null)),
            'terms' => ['required', 'in:1'],
            'profile_picture' => ['sometimes', 'image', 'mimes:jpg,jpeg,png', 'max:10242'], // Validates the profile picture
            'g-recaptcha-response' => ['required_if:captcha_status,true', new Captcha],
        ]);
    }

    protected function create(array $data)
    {
        abort_unless(config('boilerplate.access.user.registration'), 404);

        if (request()->hasFile('profile_picture')) {
            $file = request()->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName(); // Generate a unique name for the file
            $path = $file->storeAs('profile_pictures', $filename, 'public'); // Store the file in the specified disk and directory
        
            // Make sure to only store the filename or relative path in the database
            $data['profile_picture'] = $filename;
        }
        

        return $this->userService->registerUser($data);
    }
}
