<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tenancy-Register View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <x-guest-layout>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('tenant-post.register') }}">
            @csrf
            <!-- Company -->
            <div class="mb-2">
                <x-input-label for="company" :value="__('Company Name')" />
                <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')"
                    placeholder="ABC" required autofocus autocomplete="company" />
                <x-input-error :messages="$errors->get('company')" class="mt-2" />
            </div>

            <!-- Domain -->
            <div class="mb-2">
                <x-input-label for="domain" :value="__('Tenant Domain')" />

                <div class="flex item-baseline">
                    <x-text-input id="domain" class="block mt-2 mr-1 w-full" type="text" name="domain"
                        :value="old('domain')" placeholder="abc" required autofocus autocomplete="domain" />
                    <span class="mt-3"> .{{ config('tenancy.central_domains')[1] }}</span>
                </div>

            </div>
            <!-- Name -->
            <div class="mb-2">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    placeholder="Tenant Name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    placeholder="abc@gmail.com" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-2">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    placeholder="########" minlength="8" title="Password will be mimimum 8 or more digits." required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-2">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" placeholder="########" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mb-2">
                <x-input-label for="status" :value="__('Subscribe Plan')" />
                <x-text-input id="status" class="block mt-1 w-full" type="text" name="status" :value="old('status')"
                    placeholder="Basic / Standard / premium" required autofocus autocomplete="status" />
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> --}}

                <x-primary-button class="ms-4">
                    {{ __('Tenant Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout>

    <div class="d-flex justify-content-center align-items-center gap-4">

        <div style="border:1px solid black; margin-bottom: 10px;"class="p-4 text-center">
            <div>
                <h2 class="mb-2 fw-bold" style="font-size: 20px;">Basic</h2>
               <h3 class="mb-2">Capacity: 5 Blogs One Day</h3>
                <div class="mb-2">Monthly Price:  500 $</div>
                <div class="mb-2">Subscribe Description</div>
            </div>

            <input type="hidden" name="basic" id="basic" value="basic">
            <label class="btn btn-danger" for="basic">Subscribe</label>
        </div>

        <div style="border:1px solid black; margin-bottom: 10px;"class="p-4 text-center">
            <div>
                <h2 class="mb-2 fw-bold" style="font-size: 20px;">Standard</h2>
                <h3 class="mb-2">Capacity: 7 Blogs One Day</h3>
                <div class="mb-2">Monthly Price: 1000 $</div>
                <div class="mb-2">Subscribe Description</div>
            </div>

            <input type="hidden" name="standard" id="standard" value="standard">
            <label class="btn btn-danger" for="standard">Subscribe</label>
        </div>

        <div style="border:1px solid black; margin-bottom: 10px;"class="p-4 text-center">
            <div>
                <h1 class="mb-2 fw-bold" style="font-size: 20px;">Premium</h1>
                <h3 class="mb-2">Infinity Blogs One Day</h3>
                <div class="mb-2">Monthly Price: 2000 $</div>
                <div class="mb-2">Subscribe Description</div>
            </div>
            <input type="hidden" name="premium" id="premium" value="premium">
            <label class="btn btn-danger" for="premium">premium</label>

        </div>

    </div>



</body>

</html>
