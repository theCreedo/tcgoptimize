<x-layouts.site.index>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
        <div class="container mx-auto p-4">
            <h1 class="text-4xl font-bold mb-4">TCG Optimize</h1>
            <p class="text-lg mb-6">Need to set a posting to a % of TCG Low? Don't want to calculate all the numbers manually?
                Use our TCG Low Percentage Tool! Paste your post with the numbers, and we'll do the number crunching for you
                :) (Rounded to the nearest 0.50)</p>

            <form method="post" action="{{ route('transform.submit') }}" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label for="input" class="block mb-2 font-bold">Input:</label>
                    <textarea id="input" name="input" rows="10" cols="50"
                        class="w-full p-2 border border-gray-300 rounded-lg">{{ $input ?? '' }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="settings" class="block mb-2 font-bold">TCG Low:</label>
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
                    class="w-full p-2 border border-gray-300 rounded-lg">{{ $result ?? '' }}</textarea>
            </div>
        </div>
    </div>
</x-layouts.site.index>