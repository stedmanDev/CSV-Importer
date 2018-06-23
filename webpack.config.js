var CopyWebpackPlugin = require('copy-webpack-plugin');
var ExtractTextPlugin = require('extract-text-webpack-plugin');
var path = require('path');

module.exports = {
  entry: './src/js/main.js',
  mode: 'development',
  output: {
    path: path.resolve(__dirname, 'public'),
    filename: 'bundle.js'
  },
  devServer: {
    contentBase: path.join(__dirname, 'public'),
    watchContentBase: true,
    open: true
  },
  module: {
    rules: [
      {
        test: /\.(s*)css$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: ['css-loader', 'sass-loader']
        })
      }
    ]
  },
  resolve: {
    modules: [
      path.resolve(__dirname, 'node_modules'),
      path.resolve(__dirname, 'src')
    ]
  },
  plugins: [
    new ExtractTextPlugin({ filename: 'bundle.css' }),
    new CopyWebpackPlugin(
      [
        {
          from: './src/index.html',
          to: 'index.html'
        },
        {
          from: './src/data.json',
          to: 'data.json'
        },
        {
          from: './src/assets',
          to: 'assets'
        }
      ],
      {
        ignore: [],
        copyUnmodified: false
      }
    )
  ]
};
