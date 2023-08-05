@php
    $aboutActive = request()->is('home');
    $discountActive = request()->is('discount');
@endphp

<header class="p-1 bg-gray-300 flex items-center justify-between">
    <a href="{{ route('home') }}" class="flex items-center mr-8">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-60 h-auto" style="display: none;" onload="this.style.display='inline';">
    </a>

    <nav class="mr-4">
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
