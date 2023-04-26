// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      apiUrl: process.env.API_URL,
    },
  },
  modules: [],
  css: [
    // リセットcss
    '@/assets/css/reset.css',
    // ページ全体に適応させるscssの読み込み
    '@/assets/scss/main.scss',
  ],
})
