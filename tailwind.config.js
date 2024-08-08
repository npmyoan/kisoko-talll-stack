import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                nunito_sans: ["Nunito Sans", "sans-serif"],
            },
            colors: {
                "red-base": "hsl(14, 86%, 42%)",
                green: "hsl(159, 69%, 38%)",
                rose: {
                    50: "hsl(20, 50%, 98%)",
                    100: "hsl(13, 31%, 94%)",
                    300: "hsl(14, 25%, 72%)",
                    400: "hsl(7, 20%, 60%)",
                    500: "hsl(12, 20%, 44%)",
                    900: "hsl(14, 65%, 9%)",
                },
            },
        },
    },

    plugins: [forms],
};
