import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    // important: true, //this was added, but not needed according to docs
    darkMode: "class", // This enables dark mode based on the presence of the "dark" class in the HTML tag
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        // "./resources/js/**/*.vue",
        "./resources/**/*.{vue,js,ts,jsx,tsx}",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            // colors: {
            //     primary: "rgb(var(--primary))",
            //     "primary-inverse": "rgb(var(--primary-inverse))",
            //     "primary-hover": "rgb(var(--primary-hover))",
            //     "primary-active-color": "rgb(var(--primary-active-color))",

            //     "primary-highlight":
            //         "rgb(var(--primary)/var(--primary-highlight-opacity))",
            //     "primary-highlight-inverse":
            //         "rgb(var(--primary-highlight-inverse))",
            //     "primary-highlight-hover":
            //         "rgb(var(--primary)/var(--primary-highlight-hover-opacity))",

            //     "primary-50": "rgb(var(--primary-50))",
            //     "primary-100": "rgb(var(--primary-100))",
            //     "primary-200": "rgb(var(--primary-200))",
            //     "primary-300": "rgb(var(--primary-300))",
            //     "primary-400": "rgb(var(--primary-400))",
            //     "primary-500": "rgb(var(--primary-500))",
            //     "primary-600": "rgb(var(--primary-600))",
            //     "primary-700": "rgb(var(--primary-700))",
            //     "primary-800": "rgb(var(--primary-800))",
            //     "primary-900": "rgb(var(--primary-900))",
            //     "primary-950": "rgb(var(--primary-950))",

            //     "surface-0": "rgb(var(--surface-0))",
            //     "surface-50": "rgb(var(--surface-50))",
            //     "surface-100": "rgb(var(--surface-100))",
            //     "surface-200": "rgb(var(--surface-200))",
            //     "surface-300": "rgb(var(--surface-300))",
            //     "surface-400": "rgb(var(--surface-400))",
            //     "surface-500": "rgb(var(--surface-500))",
            //     "surface-600": "rgb(var(--surface-600))",
            //     "surface-700": "rgb(var(--surface-700))",
            //     "surface-800": "rgb(var(--surface-800))",
            //     "surface-900": "rgb(var(--surface-900))",
            //     "surface-950": "rgb(var(--surface-950))",
            // },
            // colors: {
            //     "primary-50": "rgb(var(--primary-50))",
            //     "primary-100": "rgb(var(--primary-100))",
            //     "primary-200": "rgb(var(--primary-200))",
            //     "primary-300": "rgb(var(--primary-300))",
            //     "primary-400": "rgb(var(--primary-400))",
            //     "primary-500": "rgb(var(--primary-500))",
            //     "primary-600": "rgb(var(--primary-600))",
            //     "primary-700": "rgb(var(--primary-700))",
            //     "primary-800": "rgb(var(--primary-800))",
            //     "primary-900": "rgb(var(--primary-900))",
            //     "primary-950": "rgb(var(--primary-950))",
            //     "surface-0": "rgb(var(--surface-0))",
            //     "surface-50": "rgb(var(--surface-50))",
            //     "surface-100": "rgb(var(--surface-100))",
            //     "surface-200": "rgb(var(--surface-200))",
            //     "surface-300": "rgb(var(--surface-300))",
            //     "surface-400": "rgb(var(--surface-400))",
            //     "surface-500": "rgb(var(--surface-500))",
            //     "surface-600": "rgb(var(--surface-600))",
            //     "surface-700": "rgb(var(--surface-700))",
            //     "surface-800": "rgb(var(--surface-800))",
            //     "surface-900": "rgb(var(--surface-900))",
            //     "surface-950": "rgb(var(--surface-950))",
            // },
        },
    },
    // neutral: {
    //     50: "#f6f7f9",
    //     100: "#ebedf3",
    //     200: "#d3d7e4",
    //     300: "#adb5cc",
    //     400: "#818daf",
    //     500: "#616f96",
    //     600: "#4c577d",
    //     700: "#3f4865",
    //     800: "#373e55",
    //     900: "#292d3d",
    //     950: "#212430",
    // },

    // customBackground: {
    //     300: "#a8bca1",
    // },
    plugins: [forms, require("tailwindcss-primeui")],
};
