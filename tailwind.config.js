/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#4caf50',
        'primary-dark': '#3e8e41',
        'accent': '#f69c27',
        'accent-dark': '#f58f0a',
        'light': '#dcefdc'
      },
      fontFamily: {
        'body': 'Poppins',
        'display': 'Mulish'
      },
      typography: {
        DEFAULT: {
          css: {
            maxWidth: '75ch'
          }
        }
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms')
  ],
}

