/** @type {import('tailwindcss').Config} */

export default {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        inter: ['Inter', 'sans-serif']
      },

      colors: {
        primary: {
                    50: 'var(--color-primary-50)',
                    100: 'var(--color-primary-100)',
                    200: 'var(--color-primary-200)',
                    300: 'var(--color-primary-300)',
                    400: 'var(--color-primary-400)',
                    500: 'var(--color-primary-500)',
                    600: 'var(--color-primary-600)',
                    700: 'var(--color-primary-700)',
                    800: 'var(--color-primary-800)',
                    900: 'var(--color-primary-900)',
                },
                accent: {
                    400: 'var(--color-accent-400)',
                    500: 'var(--color-accent-500)',
                    600: 'var(--color-accent-600)',
                },
                gray: { // Overwrite Tailwind's default gray to match our custom gray
                    100: 'var(--color-gray-100)',
                    200: 'var(--color-gray-200)',
                    700: 'var(--color-gray-700)',
                    800: 'var(--color-gray-800)',
                    900: 'var(--color-gray-900)',
                },
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography'), // Tambahkan baris ini
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
  ],
}

