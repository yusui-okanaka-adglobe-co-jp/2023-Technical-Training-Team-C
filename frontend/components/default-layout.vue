<template>
  <div>
    <Header :page-name="props.pageName" />
    <main>
      <slot></slot>
    </main>
  </div>
</template>

<script lang="ts" setup>
import Header from '@/components/header.vue'
useHead({ link: [{ rel: 'stylesheet', href: 'https://fonts.googleapis.com/css?family=Noto+Sans+JP' }] })
const props = defineProps({
  pageName: {
    type: String,
    // required: true,
    // default: () => "デフォルト値",
    // validate: (value:string) => true
  },
})
</script>
