<!--日付表示component-->
<template>
  <!--祝日判断-->
  <template v-if="props.isHoliday">
    <!--祝日-->
    <th class="horizontal-writing date-holiday-cell">
      <p class="font-size-l">{{ props.date }}</p>
      <p :class="[fontSizeHolodayTitle()]">{{ props.holidayTitle }}</p>
    </th>
  </template>
  <template v-else>
    <!--日曜判断-->
    <template v-if="props.dayOfWeek === 0">
      <th class="horizontal-writing date-holiday-cell">
        <p class="font-size-l">{{ props.date }}</p>
      </th>
    </template>
    <!--日曜以外-->
    <template v-else>
      <th class="horizontal-writing date-cell">
        <p class="font-size-l">{{ props.date }}</p>
      </th>
    </template>
  </template>
</template>
<script lang="ts" setup>
const props = defineProps({
  isHoliday: {
    type: Boolean,
    required: true,
  },
  dayOfWeek: {
    type: Number,
    required: true,
  },
  date: {
    type: String,
    requied: true,
  },
  holidayTitle: {
    type: String,
    default: () => '',
  },
})
/* 祝日名の文字の大きさを決める */
function fontSizeHolodayTitle() {
  const holidayTitleLength = props.holidayTitle?.length
  if (holidayTitleLength >= 9) {
    return 'font-size-s'
  }
  if (holidayTitleLength >= 7) {
    return 'font-size-m'
  }
  return 'font-size-l'
}
</script>

<style lang="scss" scoped>
@import '../assets/scss/timetable.scss';

@media only screen and (max-width: 767px) {
}
</style>
