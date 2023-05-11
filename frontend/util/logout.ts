export function commonLogout() {
  const config = useRuntimeConfig()
  useFetch('/api/logout', {
    baseURL: config.public.apiUrl,
    credentials: 'include',
  })
}
