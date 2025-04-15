<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Kasir</title>

    <!-- Import Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Import Animate.css untuk efek animasi -->
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

        /* Animasi loading fullscreen */
        #preloader {
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        /* Animasi spinner */
        .spinner {
            width: 80px;
            height: 80px;
            border: 6px solid rgba(255, 255, 255, 0.2);
            border-top-color: cyan;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="animated-bg h-screen bg-cover bg-center" style="background-image: url('{{ asset('assets/img/sss.jpg') }}');">

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Container Login -->
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white bg-opacity-20 backdrop-blur-lg p-8 rounded-lg shadow-lg w-96 
            animate__animated animate__fadeInDown glow-box">
            
            <!-- Logo -->
            <div class="flex justify-center">
                <img src="{{ asset('assets/img/k.jpg') }}" alt="Logo" class="w-20 h-20 mb-4">
            </div>

            <h2 class="text-center neon-text text-2xl font-semibold mb-4">Aplikasi Kasir</h2>

            <!-- Form Login -->
            <form class="space-y-4" method="POST" action="{{ route('login') }}" onsubmit="showLoader(event)">
                {{ csrf_field() }}

                <div>
                    <label for="email" class="block text-white font-semibold">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 rounded-md bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="password" class="block text-white font-semibold">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 rounded-md bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit"
                    class="w-full glow-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded-md transition duration-300">
                    Login
                </button>
            </form>
        </div>
    </div>

    <script>
        function showLoader(event) {
            event.preventDefault(); // Mencegah form submit langsung
            document.getElementById('preloader').style.opacity = "1"; // Tampilkan preloader

            // Tunggu 2 detik sebelum submit form
            setTimeout(() => {
                document.getElementById('preloader').style.opacity = "0"; // Sembunyikan preloader
                setTimeout(() => {
                    event.target.submit();
                }, 500);
            }, 2000);
        }

        // Hilangkan preloader setelah halaman dimuat
        window.onload = function() {
            document.getElementById('preloader').style.opacity = "0";
            setTimeout(() => {
                document.getElementById('preloader').style.display = "none";
            }, 500);
        };
    </script>

</body>
</html>
