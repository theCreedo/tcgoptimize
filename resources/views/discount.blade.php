@extends('layouts.index')

@section('title', 'Discount Slasher')

@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
        <div class="container mx-auto p-4">
            <h1 class="text-4xl font-bold mb-4">Discount Slasher</h1>
            <p class="text-lg mb-6">Need to set a posting to a % of your prices? Don't want to calculate all the numbers manually?
                
            
            Use our Discount Slasher! Paste your post with the numbers (make sure to add $ signs), and we'll do the number crunching for you
                :)</p>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <h4 class="font-bold mb-2">Please fix the following errors:</h4>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (isset($success) && $success && isset($statistics))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    <h4 class="font-bold mb-2">Calculation Complete!</h4>
                    <div class="text-sm">
                        <p><strong>Prices found:</strong> {{ $statistics['total_original'] > 0 ? count($calculationResult['original_prices'] ?? []) : 0 }}</p>
                        <p><strong>Total original value:</strong> ${{ number_format($statistics['total_original'], 2) }}</p>
                        <p><strong>Total discounted value:</strong> ${{ number_format($statistics['total_discounted'], 2) }}</p>
                        <p><strong>Total savings:</strong> ${{ number_format($statistics['total_savings'], 2) }}</p>
                    </div>
                </div>
            @endif

            <form method="post" action="{{ route('discount.submit') }}" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label for="input" class="block mb-2 font-bold">Input:</label>
                    <textarea id="input" name="input" rows="10" cols="50"
                        class="w-full p-2 border @error('input') border-red-500 @else border-gray-300 @enderror rounded-lg"
                        placeholder="WTS CONUS Only

1x RF Fyendal's Spring Tunic $250
1x CF Crown of Providence $300
1x RF Eye of Ophidia $550">{{ old('input', $input ?? '') }}</textarea>
                    @error('input')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="settings" class="block mb-2 font-bold">Discount to:</label>
                    <select name="settings" id="settings" class="w-full p-2 border border-gray-300 rounded-lg">
                        <option value="95" @if(session('selected_settings') == '95') selected @endif>95%</option>
                        <option value="90" @if(session('selected_settings') == '90') selected @endif>90%</option>
                        <option value="85" @if(session('selected_settings') == '85') selected @endif>85%</option>
                        <option value="80" @if(session('selected_settings') == '80') selected @endif>80%</option>
                        <option value="75" @if(session('selected_settings') == '75') selected @endif>75%</option>
                        <option value="70" @if(session('selected_settings') == '70') selected @endif>70%</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Slash the
                    Price</button>
            </form>

            <div>
                <label for="result" class="block mb-2 font-bold">Result:</label>
                <textarea id="result" name="result" rows="10" cols="50"
                    class="w-full p-2 border border-gray-300 rounded-lg"
                    placeholder="">{{ $result ?? '' }}</textarea>
            </div>
            <div class="mt-4">
                <button id="copyButton" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Copy</button>
            </div>

            <div id="notification" class="hidden bg-green-500 text-white font-bold py-2 px-4 rounded mt-4">
                Text copied to clipboard!
            </div>
        </div>
    </div>

    <style>
        #notification {
            @apply hidden bg-green-500 text-white font-bold py-2 px-4 rounded mt-4;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>

    <script>
        document.getElementById('copyButton').addEventListener('click', function() {
            var resultTextarea = document.getElementById('result');
            resultTextarea.select();
            resultTextarea.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand('copy');
        });
    </script>
@endsection