<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<style>
    /* Efek Glow pada Box */
    .glow-box {
        box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        transition: all 0.3s ease-in-out;
    }

    .glow-box:hover {
        box-shadow: 0 0 30px rgba(0, 255, 255, 0.8), 0 0 50px rgba(0, 255, 255, 0.5);
    }

    /* Efek Neon Text */
    .neon-text {
        color: #fff;
        text-shadow: 0 0 5px cyan, 0 0 10px cyan, 0 0 15px cyan, 0 0 20px cyan;
        animation: neonGlow 1.5s infinite alternate;
    }

    @keyframes neonGlow {
        from {
            text-shadow: 0 0 5px cyan, 0 0 10px cyan, 0 0 15px cyan, 0 0 20px cyan;
        }
        to {
            text-shadow: 0 0 10px cyan, 0 0 20px cyan, 0 0 30px cyan, 0 0 40px cyan;
        }
    }

    /* Efek Cahaya di Tombol */
    .glow-button {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
    }

    .glow-button::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(0, 255, 255, 0.4) 10%, transparent 50%);
        transform: rotate(25deg);
        transition: all 0.5s ease-in-out;
    }

    .glow-button:hover::before {
        top: -30%;
        left: -30%;
        transform: rotate(0deg);
    }

    /* Efek Animasi Background */
    @keyframes glowingBackground {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .animated-bg {
        background-size: 300% 300%;
        animation: glowingBackground 6s infinite alternate;
    }
</style>

<div class="flex justify-center items-center h-screen bg-cover bg-center animated-bg" 
    style="background-image: url('{{ asset('assets/img/sss.jpg') }}');">
    
    <div class="bg-white bg-opacity-20 backdrop-blur-lg p-8 rounded-lg shadow-lg w-96 
                animate__animated animate__zoomIn transition-all duration-500 glow-box">
        
        <!-- Logo -->
        <div class="flex justify-center">
            <img src="{{ asset('assets/img/k.jpg') }}" alt="Logo" class="w-20 h-20 mb-4 transform transition-all duration-500 hover:rotate-12">
        </div>
        <h2 class="text-center neon-text text-2xl font-bold mb-4">Register</h2>

        <!-- Form Register -->
        <form class="space-y-6" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="relative">
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full px-4 py-2 rounded-md bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-blue-500 peer">
                <label for="name" class="absolute left-4 top-2 text-gray-400 transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                    Name
                </label>
                @if ($errors->has('name'))
                    <span class="text-red-500 text-sm">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="relative">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 rounded-md bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-blue-500 peer">
                <label for="email" class="absolute left-4 top-2 text-gray-400 transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                    Email
                </label>
                @if ($errors->has('email'))
                    <span class="text-red-500 text-sm">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="relative">
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 rounded-md bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-blue-500 peer">
                <label for="password" class="absolute left-4 top-2 text-gray-400 transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                    Password
                </label>
                @if ($errors->has('password'))
                    <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="relative">
                <input id="password-confirm" type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 rounded-md bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-blue-500 peer">
                <label for="password-confirm" class="absolute left-4 top-2 text-gray-400 transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                    Confirm Password
                </label>
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-400 to-blue-600 hover:from-blue-500 hover:to-blue-700 text-white font-bold py-2 rounded-md transition duration-500 transform hover:scale-105 glow-button">
                Register
            </button>
        </form>
    </div>
</div>
