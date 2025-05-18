/** @type {import('tailwindcss').Config} */

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./**/*.html",
  ],
  theme: {
    extend: {
      fontFamily: {
        inter: ['Inter']
      }
    },
  },
  plugins: [
    
  ],
}

