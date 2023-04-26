// import { defineNuxtConfig } from 'nuxt'

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      apiUrl: process.env.API_URL,
    },
  },
  modules: ['@nuxtjs/tailwindcss'],
  css: [
    // リセットcss
    '@/assets/css/reset.css',

    // ページ全体に適応させるscssの読み込み
    '@/assets/scss/main.scss',
  ],
  build: {
    transpile: ['@vuepic/vue-datepicker'],
  },

  ssr: false,
})
