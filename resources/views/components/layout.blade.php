<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ntiro | Job Board</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

</head>

<body class="mx-auto mt-10 max-w-2xl bg-linear-to-r/srgb from-indigo-200 to-teal-400 text-slate-700">
<nav class=" mb-8  flex justify-between text-lg font-medium">
    <ul class="flex space-x-2">
        <li>
            <a href="{{ route('jobs.index') }}" class="text-2xl font-bold text-slate-800">HOME</a>
        </li>
    </ul>
    <ul class="flex space-x-2">
        @auth
            <li>
                <a href="{{ route('my-job-applications.index') }}">
                    {{ auth()->user()->name ?? 'anynomus' }}: Applications
                </a>
            </li>
            <li>
                <a href="{{ route('my-jobs.index')}}"> My Jobs</a>
            </li>
            <li>
                <form action="{{ route('auth.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE') {{-- method spoofing --}}
                    <button class="text-sm flex py-1">
                        | Logout 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                          </svg>
                          
                    </button>    
                </form>
            </li>
        @else
            <li>
                <a href="{{ route('auth.create') }}" class="text-sm flex py-1">
                    Sign In
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                      </svg>                      
                </a>
            </li>
        @endauth
        
    </ul>

</nav>
@if (session('success'))
    <div class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-sm text-green-700 opacity-75" role="alert">
        <p class="font-bold"> Success!
            {{ session('success') }}
        </p>
    </div>
@endif
@if (session('error'))
    <div class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-sm text-red-700 opacity-75" role="alert">
        <p class="font-bold"> Error!
            {{ session('error') }}
        </p>
    </div>
@endif

    {{ $slot }}
</body>

</html>