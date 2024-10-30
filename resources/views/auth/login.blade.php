<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="w-full max-w-md p-6 bg-white rounded shadow-md">
        <div class="flex items-center justify-center mb-5 ">
            <a href="{{url('/')}}" >
                <img class="logo" src="{{ asset('assets/img/logo.png') }}" alt="Logo">
            </a>
        </div>
        <!-- Formulário de Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Usuário</label>
                <div class="relative">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="input-login" placeholder="usuario@email.com" 
                           autocomplete="username">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3" style="color: #171717;">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.1735 15.6896C15.9836 13.6326 14.15 12.1576 12.0102 11.4584C13.0686 10.8283 13.891 9.86812 14.351 8.7254C14.8109 7.58268 14.8831 6.32056 14.5563 5.13287C14.2296 3.94518 13.522 2.89759 12.5422 2.15097C11.5624 1.40436 10.3647 1 9.13284 1C7.90102 1 6.70325 1.40436 5.72349 2.15097C4.74372 2.89759 4.03612 3.94518 3.70936 5.13287C3.3826 6.32056 3.45474 7.58268 3.91471 8.7254C4.37467 9.86812 5.19703 10.8283 6.2555 11.4584C4.11565 12.1568 2.28206 13.6318 1.09222 15.6896C1.04858 15.7608 1.01964 15.8399 1.0071 15.9225C0.994555 16.005 0.998666 16.0892 1.01919 16.1701C1.03971 16.251 1.07623 16.3269 1.12658 16.3935C1.17694 16.46 1.24012 16.5158 1.31239 16.5576C1.38466 16.5993 1.46456 16.6262 1.54738 16.6365C1.63019 16.6469 1.71425 16.6406 1.79458 16.6179C1.87491 16.5953 1.94989 16.5568 2.0151 16.5047C2.08031 16.4526 2.13442 16.388 2.17425 16.3146C3.64612 13.7709 6.24768 12.2521 9.13284 12.2521C12.018 12.2521 14.6196 13.7709 16.0914 16.3146C16.1313 16.388 16.1854 16.4526 16.2506 16.5047C16.3158 16.5568 16.3908 16.5953 16.4711 16.6179C16.5514 16.6406 16.6355 16.6469 16.7183 16.6365C16.8011 16.6262 16.881 16.5993 16.9533 16.5576C17.0256 16.5158 17.0887 16.46 17.1391 16.3935C17.1895 16.3269 17.226 16.251 17.2465 16.1701C17.267 16.0892 17.2711 16.005 17.2586 15.9225C17.246 15.8399 17.2171 15.7608 17.1735 15.6896ZM4.75784 6.62713C4.75784 5.76183 5.01443 4.91597 5.49516 4.19651C5.97589 3.47704 6.65917 2.91629 7.4586 2.58515C8.25803 2.25402 9.13769 2.16738 9.98636 2.33619C10.835 2.505 11.6146 2.92168 12.2264 3.53353C12.8383 4.14539 13.255 4.92494 13.4238 5.77361C13.5926 6.62227 13.5059 7.50194 13.1748 8.30137C12.8437 9.10079 12.2829 9.78407 11.5635 10.2648C10.844 10.7455 9.99813 11.0021 9.13284 11.0021C7.9729 11.0009 6.86082 10.5396 6.04062 9.71935C5.22042 8.89915 4.75908 7.78707 4.75784 6.62713Z" fill="#F5F5F5"/>
                        </svg>
                    </span>                        
                </div>
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>                
                <div class="relative">
                    <input id="password" type="password" name="password" required
                           class="input-login" 
                           autocomplete="current-password">    
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3" style="color: #171717;">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M15.75 6.625H13.25V4.75C13.25 3.75544 12.8549 2.80161 12.1517 2.09835C11.4484 1.39509 10.4946 1 9.5 1C8.50544 1 7.55161 1.39509 6.84835 2.09835C6.14509 2.80161 5.75 3.75544 5.75 4.75V6.625H3.25C2.91848 6.625 2.60054 6.7567 2.36612 6.99112C2.1317 7.22554 2 7.54348 2 7.875V16.625C2 16.9565 2.1317 17.2745 2.36612 17.5089C2.60054 17.7433 2.91848 17.875 3.25 17.875H15.75C16.0815 17.875 16.3995 17.7433 16.6339 17.5089C16.8683 17.2745 17 16.9565 17 16.625V7.875C17 7.54348 16.8683 7.22554 16.6339 6.99112C16.3995 6.7567 16.0815 6.625 15.75 6.625ZM7 4.75C7 4.08696 7.26339 3.45107 7.73223 2.98223C8.20107 2.51339 8.83696 2.25 9.5 2.25C10.163 2.25 10.7989 2.51339 11.2678 2.98223C11.7366 3.45107 12 4.08696 12 4.75V6.625H7V4.75ZM15.75 16.625H3.25V7.875H15.75V16.625ZM10.4375 12.25C10.4375 12.4354 10.3825 12.6167 10.2795 12.7708C10.1765 12.925 10.0301 13.0452 9.85877 13.1161C9.68746 13.1871 9.49896 13.2057 9.3171 13.1695C9.13525 13.1333 8.9682 13.044 8.83709 12.9129C8.70598 12.7818 8.61669 12.6148 8.58051 12.4329C8.54434 12.251 8.56291 12.0625 8.63386 11.8912C8.70482 11.7199 8.82498 11.5735 8.97915 11.4705C9.13332 11.3675 9.31458 11.3125 9.5 11.3125C9.74864 11.3125 9.9871 11.4113 10.1629 11.5871C10.3387 11.7629 10.4375 12.0014 10.4375 12.25Z" fill="#F5F5F5"/>
                            </svg>
                    </span>
                </div>
                @error('password')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-center mt-5">
                <a href="{{url('/')}}" class="button-primary mr-5">
                        Cancelar 
                </a>
                
                <button type="submit" class="button-primary">
                    Entrar
                </button>
            </div>
        </form>

    </div>
</body>
</html>
