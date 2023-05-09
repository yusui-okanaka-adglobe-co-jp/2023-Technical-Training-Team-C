// 認証用middleware
// 教師用のページにアクセスした際に利用する

// 利用方法
// <script lang="ts" setup>
// definePageMeta({
//   middleware: 'auth'
// })
// </script>
export default defineNuxtRouteMiddleware(async () => {
  const config = useRuntimeConfig()
  const route = useRouter()

  const { data :status } = await useFetch('/api/auth', {
    baseURL: config.public.apiUrl,
    credentials: 'include',
  })
  if(status.value === 'success'){
    // トークンが正しい場合にページの表示
    return
  } else {
    // トークンが正しくない場合はログイン画面にリダイレクト
    return route.push('/teachersLogin')
  }
});