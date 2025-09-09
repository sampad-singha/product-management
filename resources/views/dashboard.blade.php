<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512...your-hash..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100" x-data="{ sidebarOpen: true }">
<div x-data="{
        sidebarOpen: localStorage.getItem('sidebarOpen')
                     ? JSON.parse(localStorage.getItem('sidebarOpen'))
                     : window.innerWidth >= 1024
    }"
     x-init="$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', value))"
     class="flex h-screen">

    <!-- Sidebar -->
    <div :class="sidebarOpen ? 'w-64' : 'w-16'"
         class="bg-white shadow-md flex flex-col transition-all duration-300 overflow-hidden">
        <div class="flex items-center justify-between p-4">
            <h2 x-show="sidebarOpen" class="text-xl font-semibold text-gray-800"><a href="{{route('dashboard')}}">Dashboard</a></h2>
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 hover:text-gray-900">
                <i class="fas" :class="sidebarOpen ? 'fa-angle-left' : 'fa-angle-right'"></i>
            </button>
        </div>
        <nav class="mt-6 flex-1">
            <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                <i class="fas fa-list mr-3"></i>
                <span x-show="sidebarOpen">Category</span>
            </a>
            <a href="{{ route('products.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                <i class="fas fa-box mr-3"></i>
                <span x-show="sidebarOpen">Product</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto transition-all duration-300">
        <main class="p-6 h-full flex flex-col justify-center items-center text-center">
            @if(request()->routeIs('dashboard'))
                <h1 class="text-2xl font-bold mb-4">Welcome to Product Management</h1>
                <p class="text-gray-600">Use the sidebar to navigate through different sections.</p>
            @else
                @yield('content')
            @endif
        </main>
    </div>

</div>

<script>
    // Optional: adjust sidebar state on window resize only if no stored preference
    window.addEventListener('resize', () => {
        const sidebar = document.querySelector('[x-data]');
        if (!localStorage.getItem('sidebarOpen')) {
            sidebar.__x.$data.sidebarOpen = window.innerWidth >= 1024;
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
@stack('scripts')
</body>
</html>
