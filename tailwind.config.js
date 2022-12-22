const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                default: '0 2px 4px 0 rgba(0,0,0,0.10)',
            },
            colors: {
                'main-red': '#9e1010',
                'main-blue': '#0B032D',
                'main-light': '#FFB997',
                'secondary-blue': '#0A2463',
            },
            backgroundImage: {
                'welcome-lg': "url('/public/images/header.webp')",
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
