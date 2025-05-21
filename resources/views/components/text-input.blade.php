@props(['disabled' => false, 'type' => 'text'])

@if ($type === 'password')
    <div class="relative">
        <input
            id="{{ $attributes->get('id') }}"
            type="password"
            @disabled($disabled)
            {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-full shadow-sm pr-10']) }}
        >

        <!-- Font Awesome Eye Icon -->
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
             onclick="togglePassword('{{ $attributes->get('id') }}')">
            <i id="eyeIcon-{{ $attributes->get('id') }}" class="fa-solid fa-eye text-gray-500"></i>
        </div>
    </div>
@else
    <input
        type="{{ $type }}"
        @disabled($disabled)
        {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-full shadow-sm']) }}
    >
@endif
