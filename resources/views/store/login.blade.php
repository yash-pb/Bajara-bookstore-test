<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <div class="flex h-screen min-h-full flex-col justify-center px-6 py-12 lg:px-8 bg-neutral-200">
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm bg-white px-5 py-5 rounded-lg">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h1 class="text-2xl font-bold text-center">Book Store</h1>
                <h2 class="mt-7 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
                @if(Session::has('msg'))
                    <p class="error text-{{Session::get('color')}}-500 text-xs italic text-center my-5">{{Session::get('msg')}}</p>
                @endif
            </div>
            <form class="space-y-5" action="{{ route('user.login') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" placeholder="Enter email" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('email')
                            <div class="error text-red-500 text-xs italic">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" placeholder="Enter password" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('password')
                            <div class="error text-red-500 text-xs italic">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-sm text-right">
                    <a href="{{ route('user.forgot.password') }}" data-modal-target="default-modal" data-modal-toggle="default-modal" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                </div>
        
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded text-white w-full">Sign in</button>
                </div>

                <div class="text-sm text-center">
                    <a href="{{ route('user.register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Register as new user</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>