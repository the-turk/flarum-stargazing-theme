// copy necessary files and directories with webpack
// more info on https://github.com/webpack-contrib/copy-webpack-plugin

const flarumConfig = require('flarum-webpack-config');
const CopyPlugin = require('copy-webpack-plugin');

let config = flarumConfig();

config.plugins = config.plugins || [];

config.plugins.push(new CopyPlugin([
	{
		from: 'node_modules/bubbly-bg/dist/bubbly-bg.js',
		to: '../../assets/bubbly-bg.js'
	},
]));

module.exports = config;
