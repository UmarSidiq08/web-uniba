/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/**/*.php",
    "./public/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'mint-primary': '#00c9a7',
        'mint-secondary': '#00bcd4',
        'mint-dark': '#00a693',
        'mint-light': '#4dd0e1',
        'mint-blue': '#0891b2',
      },
      animation: {
        'fade-in-up': 'fadeInUp 0.6s ease forwards',
        'pulse-slow': 'pulse 2s ease-in-out infinite alternate',
      },
      keyframes: {
        fadeInUp: {
          '0%': {
            opacity: '0',
            transform: 'translateY(30px)',
          },
          '100%': {
            opacity: '1',
            transform: 'translateY(0)',
          },
        }
      }
    },
  },
  plugins: [],
}
