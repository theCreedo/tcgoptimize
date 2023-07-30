<x-layouts.site.index>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div>
            <h1>TCG Optimize</h1>
            <p>Need to set a posting to a % of TCG Low? Don't want to calculate all the numbers manually? Use our TCG Low Percentage Tool! Paste your post with the numbers, and we'll to the number crunching for you :) (Rounded to the nearest 0.50)</p>
            <form method="post" action="{{ route('transform.submit') }}">
                @csrf
                <div>
                    <label for="input">Input:</label>
                    <textarea id="input" name="input" rows="10" cols="50">
                        @isset($input)
                            {{ $input }}
                        @endisset
                    </textarea>
                </div>

                <label for="settings">TCG Low:</label>
                <select name="settings" id="settings">
                    <option value="95">95%</option>
                    <option value="90">90%</option>
                    <option value="85">85%</option>
                    <option value="80">80%</option>
                    <option value="75">75%</option>
                    <option value="70">70%</option>
                </select>
                <button type="submit">Slash the Price</button>


                <div>
                    <label for="result">Result:</label>
                    <textarea id="result" name="result" rows="10" cols="50">
                        @isset($result)
                            {{ $result }}
                        @endisset
                    </textarea>
                </div>
            </form>
        </div>
    </div>
</x-layouts.site.index>