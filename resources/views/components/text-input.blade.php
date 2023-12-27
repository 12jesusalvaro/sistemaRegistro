@props(['disabled' => false, 'exists' => false])

<input {{ $disabled || $exists ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900']) !!}>
