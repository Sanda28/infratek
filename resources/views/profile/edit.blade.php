@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Profile') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Navigasi Tab -->
            <div class="mb-4">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#profile" data-bs-toggle="tab">Ubah Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#password" data-bs-toggle="tab">Ubah Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="#delete" data-bs-toggle="tab">Hapus Akun</a>
                    </li>
                </ul>
            </div>

            <!-- Isi Tab -->
            <div class="tab-content">

                <!-- Tab Ubah Profil -->
                <div class="tab-pane fade show active" id="profile">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Tab Ubah Password -->
                <div class="tab-pane fade" id="password">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-4">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Tab Hapus Akun -->
                <div class="tab-pane fade" id="delete">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-4">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
