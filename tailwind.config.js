/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
        color: {
            "bg-blue": {
                700: 'background-color: #0047bb',
            }
        }
    },
    plugins: [],
}

