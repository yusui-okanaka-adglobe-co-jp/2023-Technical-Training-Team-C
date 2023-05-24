export async function commonLogout() {
  const router = useRouter()
  const config = useRuntimeConfig()
  await useFetch('/api/logout', {
    baseURL: config.public.apiUrl,
    credentials: 'include',
  })
  alert('ログアウト処理')
  return router.push('/teachersLogin')
}
