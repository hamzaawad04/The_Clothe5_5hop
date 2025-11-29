import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: "#14213D",
                cathover: "#FCA311",
            },
            fontFamily: {
                playfair: ['"Playfair Display"', 'serif'],
            },
        },
    },

    plugins: [forms],
};
