// 認証用middleware
// 教師用のページにアクセスした際に利用する

// 利用方法
// <script lang="ts" setup>
// definePageMeta({
//   middleware: 'auth'
// })
// </script>
export default defineNuxtRouteMiddleware(async (to, from) => {
  const config = useRuntimeConfig()
  const route = useRouter()

  const { data :status } = await useFetch('/api/auth', {
    baseURL: config.public.apiUrl,
    credentials: 'include',
  })

  // ログイン画面にアクセスした時の処理
  if(to.path === `/teachersLogin`){
    if(status.value === 'success'){
      // ログイン済み：一覧画面にリダイレクト
      return route.push('/home')
    } else {
      // 未ログイン：画面を表示
      return
    }
  }

  // その他の画面にアクセスした時の処理
  if(status.value === 'success'){
    // ログイン済みの場合：画面を表示
    return
  } else {
    // 未ログイン：ログイン画面にリダイレクト
    return route.push('/teachersLogin')
  }
});