<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-200 p-6 border-gray-400 rounded-lg">

            <h1 class="text-center font-bold text-xl">Login</h1>

            <form action="/login" method="POST" class="mt-10">

                @csrf

                <div class="mb-6">
                    <label for="username" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Username
                    </label>

                    <input value="{{ old('username') }}" type="text" class="border border-gray-400 p-2 w-full" name="username" id="username" required>
                </div>

                <div class="mb-6">
                    <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Password
                    </label>

                    <input type="password" class="border border-gray-400 p-2 w-full" name="password" id="password" required>
                </div>

                <div class="mb-6">
                    <button class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Login</button>
                </div>

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500 text-sm mt-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </form>
        </main>
    </section>
</x-layout>
