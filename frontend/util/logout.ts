export async function commonLogout() {
  const router = useRouter()
  const config = useRuntimeConfig()
  await useFetch('/api/logout', {
    baseURL: config.public.apiUrl,
    credentials: 'include',
  })
  return router.push('/teachersLogin')
}
