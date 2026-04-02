const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    safelist: [
        'bg-[#ee4d2d]',
        'bg-[#03ac0e]',
        'bg-[#0095da]',
        'bg-[#e31e54]',
        'bg-[#0f146d]',
        'bg-black',
        'bg-miruku-blue',
        'bg-gray-600',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
                cormorant: ['Cormorant Garamond', 'Georgia', 'serif'],
            },
            colors: {
                cream: {
                    50: '#fdfaf5',
                    100: '#fdf8f0',
                    200: '#faf0dc',
                },
                miruku: {
                    blue: '#3474a2',
                    dark: '#2e6392',
                },
            },
            animation: {
                'fade-in': 'fade-in 0.8s ease-out forwards',
                'slide-up': 'slide-up 0.8s ease-out forwards',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
