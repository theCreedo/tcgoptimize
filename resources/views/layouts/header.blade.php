@php
    $aboutActive = request()->is('home');
    $discountActive = request()->is('discount');
@endphp

<header class="p-1 bg-gray-300 flex items-center justify-between">
    <a href="{{ route('home') }}" class="flex items-center mr-8">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-60 h-auto" style="display: none;" onload="this.style.display='inline';">
    </a>

    <!-- Mobile Hamburger Menu Icon -->
    <button class="md:hidden px-2 py-1 text-gray-800 focus:outline-none" id="menuBtn">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>

    <nav class="mr-4 hidden md:block" id="desktopNav">
        <ul class="flex space-x-4">
            <li>
                <a href="{{ route('home') }}" class="{{ $aboutActive ? 'active' : '' }} rounded-full py-2 px-4 text-black hover:text-blue-500 hover:bg-blue-100">Home</a>
            </li>
            <li>
                <a href="{{ route('discount') }}" class="{{ $discountActive ? 'active' : '' }} rounded-full py-2 px-4 text-black hover:text-blue-500 hover:bg-blue-100">Discount Slasher</a>
            </li>
        </ul>
    </nav>
</header>

<!-- Mobile Navigation Menu -->
<div class="hidden md:hidden" id="mobileNav">
    <ul class="py-2 px-4 bg-gray-200">
        <li>
            <a href="{{ route('home') }}" class="{{ $aboutActive ? 'active' : '' }} block py-2 px-4 text-black hover:text-blue-500 hover:bg-blue-100">Home</a>
        </li>
        <li>
            <a href="{{ route('discount') }}" class="{{ $discountActive ? 'active' : '' }} block py-2 px-4 text-black hover:text-blue-500 hover:bg-blue-100">Discount Slasher</a>
        </li>
    </ul>
</div>

<!-- Add JavaScript to toggle mobile navigation -->
<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileNav = document.getElementById('mobileNav');

    menuBtn.addEventListener('click', () => {
        mobileNav.classList.toggle('hidden');
    });
</script>
