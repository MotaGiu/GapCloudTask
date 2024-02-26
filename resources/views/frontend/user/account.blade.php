@extends('frontend.layouts.app')

@section('title', __('My Account'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-frontend.card>
                <x-slot name="header">
                    @lang('My Account')
                </x-slot>

                <x-slot name="body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <x-utils.link
                                :text="__('My Profile')"
                                class="nav-link active"
                                id="my-profile-tab"
                                data-toggle="pill"
                                href="#my-profile"
                                role="tab"
                                aria-controls="my-profile"
                                aria-selected="true" />

                            <x-utils.link
                                :text="__('Edit Information')"
                                class="nav-link"
                                id="information-tab"
                                data-toggle="pill"
                                href="#information"
                                role="tab"
                                aria-controls="information"
                                aria-selected="false"/>

                            @if (! $logged_in_user->isSocial())
                                <x-utils.link
                                    :text="__('Password')"
                                    class="nav-link"
                                    id="password-tab"
                                    data-toggle="pill"
                                    href="#password"
                                    role="tab"
                                    aria-controls="password"
                                    aria-selected="false" />
                            @endif

                            <x-utils.link
                                :text="__('Two Factor Authentication')"
                                class="nav-link"
                                id="two-factor-authentication-tab"
                                data-toggle="pill"
                                href="#two-factor-authentication"
                                role="tab"
                                aria-controls="two-factor-authentication"
                                aria-selected="false"/>
                        </div>
                    </nav>

                    <div class="tab-content" id="my-profile-tabsContent">
                        <div class="tab-pane fade pt-3 show active" id="my-profile" role="tabpanel" aria-labelledby="my-profile-tab">
                            @include('frontend.user.account.tabs.profile')
                            
                            <!-- Profile Picture Update Form -->
                            <div class="mt-4">
                                <h5>@lang('Update Profile Picture')</h5>
                                <form action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="profile_picture">@lang('Choose a profile picture')</label>
                                        <input type="file" class="form-control-file" name="profile_picture" id="profile_picture" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">@lang('Upload')</button>
                                </form>
                            </div>
                        </div><!--tab-profile-->

                        <div class="tab-pane fade pt-3" id="information" role="tabpanel" aria-labelledby="information-tab">
                            @include('frontend.user.account.tabs.information')
                        </div><!--tab-information-->

                        @if (! $logged_in_user->isSocial())
                            <div class="tab-pane fade pt-3" id="password" role="tabpanel" aria-labelledby="password-tab">
                                @include('frontend.user.account.tabs.password')
                            </div><!--tab-password-->
                        @endif

                        <div class="tab-pane fade pt-3" id="two-factor-authentication" role="tabpanel" aria-labelledby="two-factor-authentication-tab">
                            @include('frontend.user.account.tabs.two-factor-authentication')
                        </div><!--tab-information-->
                    </div><!--tab-content-->
                </x-slot>
            </x-frontend.card>
        </div><!--col-md-10-->
    </div><!--row-->
</div><!--container-->
@endsection