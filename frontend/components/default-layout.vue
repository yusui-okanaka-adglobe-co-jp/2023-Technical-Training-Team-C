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
const props = defineProps({
  pageName: {
    type: String,
    // required: true,
    // default: () => "デフォルト値",
    // validate: (value:string) => true
  },
})
</script>
