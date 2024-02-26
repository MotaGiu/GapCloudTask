<!-- resources/views/frontend/user/account/tabs/profile-picture.blade.php -->

<form action="{{ route('frontend.user.profile.update-picture') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="profile_picture">{{ __('Profile Picture') }}</label>
        <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">{{ __('Update Profile Picture') }}</button>
</form>
