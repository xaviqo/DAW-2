const Dotenv = require('dotenv-webpack');
const { defineConfig } = require('@vue/cli-service');

module.exports = defineConfig({
  transpileDependencies: [
    'vuetify'
  ],
  configureWebpack: {
    plugins: [
      new Dotenv()
    ]
  }
})
