module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    // './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
    screens: {
      // Extra Small Devices (Portrait Phones, Less than 640px)
      // => @media (max-width: 640px) { ... }
      'xs': {'max': '639.98px'},
  
      // Small Devices (Landscape Phones, 640px to 768px)
      // => @media (min-width: 640px) and (max-width: 767.98px) { ... }
      'sm': {'min': '640px', 'max': '767.98px'},
  
      // Medium Devices (Tablets, 768px to 1024px)
      // => @media (min-width: 768px) and (max-width: 1023.98px) { ... }
      'md': {'min': '768px', 'max': '1023.98px'},
  
      // Large Devices (Laptops, 1024px to 1280px)
      // => @media (min-width: 1024px) and (max-width: 1279.98px) { ... }
      'lg': {'min': '1024px', 'max': '1279.98px'},
  
      // Extra Large Devices (Desktops, 1280px to 1536px)
      // => @media (min-width: 1280px) and (max-width: 1535.98px) { ... }
      'xl': {'min': '1280px', 'max': '1535.98px'},
  
      // Extra Big Large Devices (Large Desktops, 1536px to .....)
      // => @media (min-width: 1536px) { ... }
      '2xl': {'min': '1536px'},
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
