<template>
  <div class="root">
    <Header :page-name="props.pageName" />
    <main>
      <slot></slot>
    </main>
  </div>
</template>

<script lang="ts" setup>
import Header from '@/components/header.vue'
const route = useRoute()
useHead({
  link: [{ rel: 'stylesheet', href: 'https://fonts.googleapis.com/css?family=Noto+Sans+JP' }],
  title: route.meta.title as string,
})
const props = defineProps({
  pageName: {
    type: String,
    // required: true,
    // default: () => "デフォルト値",
    // validate: (value:string) => true
  },
})
</script>
<style lang="scss" scoped>
.root {
  height: 100vh;
}
</style>
