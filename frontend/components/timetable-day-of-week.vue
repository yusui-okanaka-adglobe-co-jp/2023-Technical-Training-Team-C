<!--曜日表示component-->
<template>
  <th class="horizontal-writing dayOfWeek-cell">
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
@import '../assets/scss/timetable.scss';
</style>
