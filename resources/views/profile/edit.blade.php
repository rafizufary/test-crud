@extends('layouts.layout')

@section('title', 'Profile')

{{-- <x-app-layout>  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


@section('content')    
<!-- Profile Information -->  
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Profile Information</div>
                <p>Update your account's profile information and email address.</p>
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
            
                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                class="form-control"
                                value="{{old('name', $user->name)}}" 
                                required autofocus autocomplete="name" />
                                @error('name')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                class="form-control"
                                value="{{old('email', $user->email)}}" 
                                required autofocus autocomplete="userame" />
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div>
                                        <p class="text-sm mt-2 text-gray-800">
                                            {{ __('Your email address is unverified.') }}
                    
                                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{ __('Click here to re-send the verification email.') }}
                                            </button>
                                        </p>
                    
                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-2 font-medium text-sm text-green-600">
                                                {{ __('A new verification link has been sent to your email address.') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button 
                                type="submit" 
                                class="btn btn-black mt-10">Save</button>
                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Update Email -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Update Password</div>
                <p>Ensure your account is using a long, random password to stay secure.</p>
            
                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="update_password_current_password"
                                >Current Password</label>
                                <input 
                                id="update_password_current_password" 
                                name="current_password" 
                                type="password" 
                                class="form-control"
                                autocomplete="current-password" />
                                @error('current_password')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="update_password_password"
                                >New Password</label>
                                <input 
                                id="update_password_password" 
                                name="password" 
                                type="password" 
                                class="form-control"
                                autocomplete="new-password" />
                                @error('password')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="update_password_password_confirmation"
                                >Confirm Password</label>
                                <input 
                                id="update_password_password_confirmation" 
                                name="password_confirmation" 
                                type="password" 
                                class="form-control"
                                autocomplete="new-password" />
                                @error('password_confirmation')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-black mt-10">Save</button>
                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete User -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Delete Account</div>
                <p>
                    Once your account is deleted, all of its resources and data will be permanently deleted. 
                    Before deleting your account, please download any data or information that you wish to retain.
                </p>

                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <!-- Tombol Delete Account langsung submit form -->
                            <form method="POST" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('delete')

                                <button type="submit" class="btn btn-danger mt-10">
                                    Delete Account
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection
