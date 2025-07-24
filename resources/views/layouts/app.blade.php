<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

     <style>
            body::before {
                content: "";
                background-image: url('/images/dgp_logo_bg.png'); /* Ensure this image exists in public/images */
                background-repeat: no-repeat;
                background-position: center;
                background-size: 965px;
                opacity: 0.05;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
            }
        </style>

</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">



    <!-- Layout Wrapper for sticky footer -->
    <div class="min-h-screen flex flex-col">

        @include('layouts.navigation')

        <main class="flex-grow px-2 sm:px-4 md:px-6 lg:px-8">
            {{ $slot }}
        </main>

        <footer style="background-color: #064e3b; color: white; padding: 2.5rem 1.5rem;">
            <div style="max-width: 112rem; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; text-align: center;">

                <div>
                    <h2 style="font-size: 1.5rem; font-weight: bold; color: #facc15;">DigiPet Portal</h2>
                    <p style="margin-top: 0.5rem; font-size: 0.875rem;">Bridging pet owners, veterinarians & government</p>
                </div>

                <div>
                    <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Contact</h3>
                    <p>Email: support@digipet.portal</p>
                    <p>Phone: +91-9876543210</p>
                    <p>Goa, India</p>
                </div>

                <div>
                    <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Legal</h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li><a href="#" style="text-decoration: none; color: white;">Privacy Policy</a></li>
                        <li><a href="#" style="text-decoration: none; color: white;">Terms of Service</a></li>
                        <li><a href="#" style="text-decoration: none; color: white;">Refund Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Follow Us</h3>
                    <div style="display: flex; justify-content: center; gap: 1.25rem;">
                        <a href="#" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="24" height="24">
                                <path d="M22 12a10 10 0 10-11.5 9.9v-7h-2v-2.9h2v-2.2c0-2 1.2-3.1 3-3.1.9 0 1.9.1 1.9.1v2.1h-1.1c-1 0-1.3.6-1.3 1.2v1.9h2.5l-.4 2.9h-2.1v7A10 10 0 0022 12z"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="24" height="24">
                                <path d="M8 19c7.5 0 11.6-6.2 11.6-11.6v-.5A8.3 8.3 0 0022 5.4a8.2 8.2 0 01-2.4.7 4.2 4.2 0 001.8-2.3 8.2 8.2 0 01-2.6 1 4.2 4.2 0 00-7.2 3.8A12 12 0 013 4.5a4.2 4.2 0 001.3 5.6A4.2 4.2 0 012 9.4v.1a4.2 4.2 0 003.4 4.1 4.3 4.3 0 01-1.9.1 4.2 4.2 0 003.9 2.9A8.5 8.5 0 012 18.1a12 12 0 006 1.7"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="24" height="24">
                                <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-.5a1 1 0 100 2 1 1 0 000-2z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div style="border-top: 1px solid #0f3c2d; margin-top: 2rem; padding-top: 1rem; text-align: center; font-size: 0.875rem; color: #cbd5e1;">
                © {{ now()->year }} DigiPet Portal. All rights reserved.
            </div>
        </footer>
    </div>

    <!-- Loading screen -->
    <div id="loading-screen"
         class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-white z-50">
        <div class="text-2xl font-semibold text-green-800 animate-pulse">Loading...</div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        window.addEventListener('load', function () {
            const loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.opacity = '0';
            loadingScreen.style.pointerEvents = 'none';
            setTimeout(() => loadingScreen.remove(), 500);
        });
    </script>

</body>
</html>
