// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      apiUrl: process.env.API_URL,
      //.envファイルにNUXT_PUBLIC_SCHOOL_NAME=""と書くことで値変更可能
      schoolName: 'adglobe',
    },
  },
  css: [
    // リセットcss
    '@/assets/css/reset.css',
    // ページ全体に適応させるscssの読み込み
    '@/assets/scss/main.scss',
  ],
  build: {
    transpile: ['@vuepic/vue-datepicker'],
  },
  app: {
    head: {
      link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
    },
  },
})
