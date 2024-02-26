@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Dashboard')
                    </x-slot>

                    <x-slot name="body">
                        @if($logged_in_user->type === 'admin')
                            <h1>@lang('Hello Admin')</h1>
                        @elseif($logged_in_user->type === 'user')
                            <h1>@lang('Hello User')</h1>
                        @endif

                        @lang('You are logged in!')
                        @lang('Welcome :Name', ['type' => $logged_in_user->type])
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection