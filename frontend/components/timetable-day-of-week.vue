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

@media only screen and (max-width: 767px) {
  .dayOfWeek-cell {
    word-break: break-word;
    width: 48px;
    height: 16px;
    color: #ffffff;
    background-color: #5160ae;
  }
  .font-size-l {
    font-size: 10px;
  }
}
</style>
