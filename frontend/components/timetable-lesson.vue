<template>
  <td class="lesson-cell horizontal-writing" :class="{ 'lesson-holiday-cell': isHoliday }">
    <div>
      <p class="lesson-cell-box" :class="[fontSizeClass('subject')]">{{ props.subject }}</p>
      <p class="lesson-cell-box" :class="[fontSizeClass('teacher')]">{{ props.teacherName }}</p>
    </div>
  </td>
</template>

<script lang="ts" setup>
const props = defineProps({
  subject: {
    type: String,
    default: () => '',
  },
  teacherName: {
    type: String,
    default: () => '',
  },
  isHoliday: {
    type: Boolean,
  },
})
/* 科目名／教師名の文字の大きさを決める */

function fontSizeClass(msg: string) {
  const subjectLength = props.subject.length
  const teacherNameLength = props.teacherName.length

  if (msg == 'subject') {
    if (subjectLength >= 9) {
      return 'font-size-s'
    } else if (subjectLength >= 7) {
      return 'font-size-m'
    } else if (subjectLength >= 5) {
      return 'font-size-l'
    }
    return 'font-size-xl'
  }

  if (teacherNameLength >= 9) {
    return 'font-size-s'
  }
  return 'font-size-m'
}
</script>

<style lang="scss">
@import '../assets/scss/timetable.scss';

@media only screen and (max-width: 767px) {
  td {
    text-align: center;
    width: 48px;
    height: 40px;
    font-weight: bold;
  }
  .lesson-holiday-cell {
    background-color: #f4c9c9;
  }
  .lesson-cell-box {
    margin: 0;
  }
  .font-size-xl {
    font-size: 18px;
  }
  .font-size-l {
    font-size: 8px;
  }
  .font-size-m {
    font-size: 6px;
  }
  .font-size-s {
    font-size: 6px;
  }
  .font-size-xs {
    font-size: 4px;
  }
}
</style>
