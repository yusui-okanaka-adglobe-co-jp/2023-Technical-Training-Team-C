<!--時限表示component-->
<template>
  <th class="period-cell">
    <p class="font-size-xl">{{ props.period }}</p>
  </th>
</template>

<script lang="ts" setup>
const props = defineProps({
  period: {
    type: Number,
    required: true,
  },
})
</script>
<style lang="scss" scoped>
.period-cell {
  width: 80px;
  height: 90px;
}
</style>
