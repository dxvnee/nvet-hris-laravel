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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primaryUltraLight: "#F3E8DD",
                primaryExtraLight: "#E4D0C0",
                primaryLight: "#D2B397",
                primarySoft: "#C29C79",
                primary: "#855E41",
                primarySoftDark: "#6C4A34",
                primaryDark: "#553820",
                primaryExtraDark: "#3C2716",
                primaryUltraDark: "#25180D",
            },
        },
    },

    plugins: [forms],
};
