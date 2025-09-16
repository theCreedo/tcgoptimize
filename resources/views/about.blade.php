@extends('layouts.index')

@section('title', 'About Us')

@section('content')
<div class="container mx-auto p-4">
    <section class="mb-4 p-2">
        <h1 class="text-4xl font-bold mb-4">Tools to Use</h1>
        <a href="{{ route('discount') }}"><h2 class="text-2xl font-bold mb-4">Discount Slasher</h2></a>
        <p class="text-lg text-gray-700">Check out our <a href="{{ route('discount') }}" class="text-blue-500 hover:underline">Discount Slasher Tool</a> to calculate discounts and optimize your marketplace posts!</p>
    </section>

    <section class="mb-4 p-2">
        <h2 class="text-3xl font-bold  mb-4">About TCG Optimize</h2>
        <p class="text-lg text-gray-700">TCG Optimize is founded by <a href="https://www.ericjmlee.com" class="text-blue-500 underline">Eric Lee</a>, an avid player of the TCG, <a href="https://www.fabtcg.com" class="text-blue-500 underline">Flesh and Blood</a>.</p>
    </section>

    <section class="mb-4 p-2">
        <p class="text-lg text-gray-700">When first selling on FAB, he realized he didn't want to waste time discounting the price of every item he wanted to post for sale on Facebook and Discord marketplace.</p>
    </section>

    <section class="mb-4 p-2">
        <p class="text-lg text-gray-700">So, instead of doing the grueling 15 mins of calculations, he decided to spend a week testing and building a tool to solve that problem like a true engineer.</p>
    </section>

    <section class="mb-4 p-2">
        <p class="text-lg text-gray-700">And that's how TCG Optimize was borne.</p>
    </section>

    <section class="mb-4 p-2">
        <p class="text-lg text-gray-700">With it, the goal of TCG Optimize is to create tools to equip and empower TCG players in their marketplace endeavors. If there's any feedback you have, or suggestions, feel free to reach out to Eric on discord <a href="https://discord.com/users/thecreedo" class="text-blue-500 underline">(@theCreedo)</a>.</p>
    </section>
</div>
@endsection
