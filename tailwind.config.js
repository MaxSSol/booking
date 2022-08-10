/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');
const path = require('path');

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.vue',
        path.resolve(__dirname, './node_modules/litepie-datepicker-tw3/**/*.js')
    ],
    theme: {
        extend: {
            colors: {
                'litepie-primary': colors.sky,
                'litepie-secondary': colors.gray
            }
        },
    },
    variants: {
        extend: {
            cursor: ['disabled'],
            textOpacity: ['disabled'],
            textColor: ['disabled']
        }
    },
    plugins: [],
}
