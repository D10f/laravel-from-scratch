@props(['title' => '', 'items', 'currentCategory'])

<div x-data="{ show: false }" @click.away="show = false" class="relative w-full min-w-32 flex items-center">
    <button @click="show = !show" class="py-2 pl-3 text-sm font-semibold text-left inline-flex flex-auto md:w-32">
        {{ isset($currentCategory) ? ucwords($currentCategory->name) : $title }}
    </button>
    <span
        class="h-full flex-none px-3 flex justify-center items-center hover:cursor-pointer"
        @click.stop="{{ isset($currentCategory) ? 'location.href = `http://localhost:8080`' : 'show = !show' }}"
    >
        @if(!$currentCategory)
            <svg
                {{-- class="transform -rotate-90 absolute pointer-events-none" --}}
                class="transform pointer-events-none"
                viewBox="0 0 22 22"
                {{-- style="right: 12px;" --}}
                width="22"
                height="22"
            >
                <g fill="none" fill-rule="evenodd">
                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z"></path>
                    <path fill="#222" d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                </g>
            </svg>
        @else
            <span class="text-xl hover:text-red-500">&times;</span>
        @endif
    </span>
    <ul x-show="show" class="py-2 mt-2 absolute bg-gray-200 w-full top-full rounded-xl z-50 overflow-scroll max-h-52" style="display: none;">
        @foreach ($items as $category)
            <x-dropdown-link-item
                resource="categories"
                :slug="$category->slug"
                :active="request()->is('categories/' . $category->slug)"
                {{-- :active="request()->routeIs('category')" --}}
            >
                {{ $category->name}}
            </x-dropdown-link-item>
        @endforeach
    </ul>
</div>