
const path = require('path');
const webpack = require('webpack');


module.exports = {
  entry: './src/js/bundle.js',
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'bundle.js',
  },
  
  module: {
   rules: [{
     test: /\.js$/,    
     exclude: /node_modules/,
     include: /node_modules\/bootstrap/,
     loader: 'babel-loader',
   }]
  },
  presets: [
    [
      '@babel/preset-env',
      {
        targets: {
          esmodules: false,
        },
      },
    ],
  ],
};
