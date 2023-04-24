<!--日付表示component-->
<template>
  <!--祝日判断-->
  <template v-if="!props.isHoliday">
    <!--日曜判断-->
    <template v-if="props.dayOfWeek === 0">
      <th class="date-holiday-cell">
        <p class="font-size-l date-cell-margin">{{ props.date }}</p>
      </th>
    </template>
    <!--日曜以外-->
    <template v-else>
      <th class="date-cell">
        <p class="font-size-l date-cell-margin">{{ props.date }}</p>
      </th>
    </template>
  </template>
  <!--祝日-->
  <template v-else>
    <th class="date-holiday-cell">
      <p class="font-size-l date-cell-margin">{{ props.date }}</p>
      <p class="date-cell-margin" :class="[fontSizeHolodayTitle()]">{{ props.holidayTitle }}</p>
    </th>
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
  let holidayTitleLength = props.holidayTitle?.length
  if (holidayTitleLength >= 9) {
    return 'font-size-s'
  }
  if (holidayTitleLength >= 7) {
    return 'font-size-m'
  }
  return 'font-size-l'
}
</script>

<style lang="scss" vscoped>
.date-cell {
  width: 160px;
  height: 80px;
  word-break: break-word;
}
.date-holiday-cell {
  width: 160px;
  height: 80px;
  background-color: #f4c9c9;
}
.date-cell-margin {
  margin-top: 5px;
}
</style>
