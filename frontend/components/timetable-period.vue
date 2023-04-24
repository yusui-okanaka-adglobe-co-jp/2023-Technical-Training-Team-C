<!--時限表示component-->
<template>
  <th class="horizontal-writing period-cell">
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
@import '../assets/scss/timetable.scss';

@media only screen and (max-width: 767px) {
  .period-cell {
    width: 24px;
    height: 40px;
  }
  .font-size-xl {
    font-size: 18px;
  }
}
</style>
