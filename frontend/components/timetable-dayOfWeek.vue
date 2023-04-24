<!--曜日表示component-->
<template>
  <th class="dayOfWeek-cell">
    <p class="font-size-l">{{ props.dayOfWeek }}</p>
  </th>
</template>
<script lang="ts" setup>
const props = defineProps({
  dayOfWeek: {
    type: String,
    required: true,
  },
})
</script>
<style lang="scss" scoped>
.dayOfWeek-cell {
  word-break: break-word;
  width: 160px;
  height: 40px;
  color: #ffffff;
  background-color: #5160ae;
}
</style>
