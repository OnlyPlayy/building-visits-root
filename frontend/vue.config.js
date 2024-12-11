const { defineConfig } = require('@vue/cli-service');

module.exports = defineConfig({
  transpileDependencies: true,
  devServer: {
    proxy: {
      '/api': {
        target: 'http://localhost/building-visits-root/backend', 
        changeOrigin: true,
        secure: false,
      }
    }
  }
});
