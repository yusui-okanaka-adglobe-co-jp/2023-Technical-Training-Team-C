<template>
  <div class="content">
    <p>
      Your Name:
      <input type="text" v-model="name" />
    </p>
    <button type="button" @click="greet">Greet</button>
    <ul class="content__logs">
      <li v-for="log in logs" class="content__logs__item">[{{ log.timestamp }}] {{ log.message }}</li>
    </ul>
  </div>
</template>

<script lang="ts" setup>
import { Ref } from 'vue'
import { SampleResponse } from '~~/types/response/SampleResponse'

const name = ref('')
const logs: Ref<SampleResponse[]> = ref([])

async function greet() {
  const $config = useRuntimeConfig()
  try {
    const response = await $fetch<SampleResponse>(`${$config.public.apiUrl}/api/sample`, {
      method: 'post',
      body: {
        name: name.value,
      },
    })

    logs.value.push(response)
  } catch (ex) {
    console.error(ex)
  }
}
</script>

<style lang="scss" scoped>
.content {
  &__logs {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 4px;
    padding: 0;

    &__item {
      background: #ccc;
    }
  }
}
</style>
