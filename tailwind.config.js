module.exports = {
  darkMode: 'class', // false or 'media' or 'class'
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    // './resources/**/*.vue',
  ],
  theme: {
    extend: {},
    screens: {
      // Extra Big Large Devices (Large Desktops, 1536px to .....)
      // Extra Large Devices (Desktops, 1280px to 1536px)
      // Large Devices (Laptops, 1024px to 1280px)
      // Medium Devices (Tablets, 768px to 1024px)
      // Small Devices (Landscape Phones, 640px to 768px)
      // Extra Small Devices (Portrait Phones, Less than 640px)
      
      // Min-Width
      '2xl': '1536px',
      'xl': '1280px',
      'lg': '1024px',
      'md': '768px',
      'sm': '640px',
      'xs': {'max': '639.98px'},
  
      // Max-Width
      /*'xl': {'max': '1535.98px'},
      'lg': {'max': '1279.98px'},
      'md': {'max': '1023.98px'},
      'sm': {'max': '767.98px'},
      'xs': {'max': '639.98px'},*/
      
      /*'2xl': {'min': '1536px'},
      'xl': {'min': '1280px', 'max': '1535.98px'},
      'lg': {'min': '1024px', 'max': '1279.98px'},
      'md': {'min': '768px', 'max': '1023.98px'},
      'sm': {'min': '640px', 'max': '767.98px'},
      'xs': {'max': '639.98px'},*/
      
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
