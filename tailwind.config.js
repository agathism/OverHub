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
        'ow-maroon': '#D17D98',
        'ow-violet': '#FFE7E7',
        'ow-pink': '#F4CCE9',
        'ow-dark-blue': '#AFDDFF',
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