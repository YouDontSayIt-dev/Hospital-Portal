/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./dist/*.{html,js}"],
  theme: {
    extend: {
      colors: {
        "custom-color": "#F1FCFD", // bg-custom-color
        "side-navbar": "#3D98AA", // bg-side-navbar
        "side-navbar-active-text": "#3D98AA", // text-side-navbar-active-text
        "search-bar": "#2EB9B9", // bg-search-bar
        "gray-text": "#5C5C5C", // text-gray-text
        "sidebar-text-bold": "#246673", // text-sidebar-text-bold
        "save-button": "#FFC300", // bg-save-button
        "login-font-clr": "#68E3EA" // text-login-font-clr
      },
      fontFamily: {
        Commissioner: ["Commissioner", "sans-serif"],
      },
      boxShadow: {
        'custom': '0px 4px 20px rgba(0, 0, 0, 0.15)',
      },
    },
  },
  plugins: [],
}