<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Optional: Enable dark mode based on system setting
        tailwind.config = {
            darkMode: 'media', // or 'class'
        };
    </script>
    <style>
        /* Optional: Prevent scrolling while loading */
        body.loading {
            overflow: hidden;
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
</head>

<body class="loading">

    <!-- ✅ Loading Screen -->
    <div id="loader"
        class="fixed inset-0 bg-gray-100 dark:bg-gray-900 z-50 flex flex-col items-center justify-center transition-opacity duration-500">
        <!-- Your Logo -->
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ab/Logo_TV_2015.png" alt="Logo"
            class="w-10 h-10 mb-4">

        <!-- Spinner -->
        <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mb-3"></div>

        <!-- Loading Text -->
        <p class="text-gray-800 dark:text-gray-200 text-sm">Loading...</p>
    </div>

    <!-- ✅ Main Page Content -->
    <!-- ✅ Navbar -->
    <header class="bg-white shadow-md fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-blue-600">TaskManager</div>
            <nav class="hidden md:flex gap-6">
                <a href="#home" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
                <a href="#features" class="text-gray-700 hover:text-blue-600 font-medium">Features</a>
                <a href="#about" class="text-gray-700 hover:text-blue-600 font-medium">About</a>
                <a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium">Contact</a>
            </nav>
            <div class="md:hidden">
                <button id="menu-btn" class="focus:outline-none">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden px-4 pb-4">
            <a href="#home" class="block py-2 text-gray-700 hover:text-blue-600">Home</a>
            <a href="#features" class="block py-2 text-gray-700 hover:text-blue-600">Features</a>
            <a href="#about" class="block py-2 text-gray-700 hover:text-blue-600">About</a>
            <a href="#contact" class="block py-2 text-gray-700 hover:text-blue-600">Contact</a>
        </div>
    </header>

    <!-- ✅ Hero Section -->
    <section id="home" class="pt-28 pb-16 bg-gradient-to-r from-blue-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center gap-12">
            <div class="flex-1">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Manage Your Tasks <br> Like a Pro</h1>
                <p class="text-gray-600 mb-6 text-lg">Organize your work, set deadlines, and stay productive with our
                    easy-to-use task manager.</p>
                <a href="#"
                    class="inline-block px-6 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition duration-300">Get
                    Started</a>
            </div>
            <div class="flex-1">
                <img src="https://illustrations.popsy.co/gray/task-management.svg" alt="Task Management Illustration"
                    class="w-full max-w-md mx-auto">
            </div>
        </div>
    </section>

    <!-- ✅ Features Section -->
    <section id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 shadow-md rounded-xl border border-gray-100 text-center">
                    <h3 class="text-xl font-semibold mb-2 text-blue-600">Task Planning</h3>
                    <p class="text-gray-600">Plan your daily, weekly, or monthly tasks with ease and clarity.</p>
                </div>
                <div class="p-6 shadow-md rounded-xl border border-gray-100 text-center">
                    <h3 class="text-xl font-semibold mb-2 text-blue-600">Deadline Tracking</h3>
                    <p class="text-gray-600">Never miss a deadline with smart reminders and priority tagging.</p>
                </div>
                <div class="p-6 shadow-md rounded-xl border border-gray-100 text-center">
                    <h3 class="text-xl font-semibold mb-2 text-blue-600">Team Collaboration</h3>
                    <p class="text-gray-600">Work with your team and assign tasks efficiently in one place.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ✅ About Section -->
    <section id="about" class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">About Our Tool</h2>
            <p class="text-gray-600 text-lg">TaskManager is built to help individuals and teams organize their work
                better and achieve more. Whether you're a freelancer or a company, we've got the tools you need.</p>
        </div>
    </section>

    <!-- ✅ Contact Section -->
    <section id="contact" class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Get in Touch</h2>
            <p class="text-gray-600 mb-6">Have questions? Reach out and we’ll be happy to help you.</p>
            <a href="mailto:support@taskmanager.com"
                class="text-blue-600 font-medium underline">support@taskmanager.com</a>
        </div>
    </section>

    <!-- ✅ Footer -->
    <footer class="bg-blue-600 text-white py-6">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm">
            <p>&copy; 2025 TaskManager. All rights reserved.</p>
            <div class="flex space-x-4 mt-2 md:mt-0">
                <a href="#" class="hover:underline">Privacy Policy</a>
                <a href="#" class="hover:underline">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- ✅ jQuery + Loader Hide Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(window).on('load', function() {
            // Optional delay (e.g., 2 seconds)
            setTimeout(() => {
                $('#loader').fadeOut(600);
                $('body').removeClass('loading');
            }, 1000); // you can increase to 3000 for 3 seconds
        });
    </script>

</body>

</html>
