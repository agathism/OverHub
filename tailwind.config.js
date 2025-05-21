/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        // Couleurs principales
        'ow-blue': '#010444',
        'ow-violet': '#7D1C4A',
        'ow-pink': '#bb1b70',
        'ow-light-blue': '#020ab6',
        // Couleurs neutres
        'ow-white': '#FFFFFF',
        'ow-light-gray': '#F5F5F7',
      },
      animation: {
        'blob-bounce': 'blob-bounce 5s infinite ease',
      },
      keyframes: {
        'blob-bounce': {
          '0%': {
            transform: 'translate(-100%, -100%) translate3d(0, 0, 0)',
          },
          '25%': {
            transform: 'translate(-100%, -100%) translate3d(100%, 0, 0)',
          },
          '50%': {
            transform: 'translate(-100%, -100%) translate3d(100%, 100%, 0)',
          },
          '75%': {
            transform: 'translate(-100%, -100%) translate3d(0, 100%, 0)',
          },
          '100%': {
            transform: 'translate(-100%, -100%) translate3d(0, 0, 0)',
          },
        },
      },
    },
  },
  plugins: [],
};