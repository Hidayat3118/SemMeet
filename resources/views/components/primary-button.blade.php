<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'mt-4 w-full font-semibold justify-center font-semibold bg-blue-500 inline-flex items-center px-4 py-3 bg-blue-500 dark:bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-blue-600 dark:hover:bg-white focus:bg-blue-500 dark:focus:bg-white active:bg-blue-500 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
