<template>
  <td :class="{ 'lesson-holiday-cell': isHoliday }">
    <div>
      <p class="lessonCell-box" :class="[fontSizeClass('subject')]">{{ props.subject }}</p>
      <p class="lessonCell-box" :class="[fontSizeClass('teacher')]">{{ props.teacherName }}</p>
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
  let subjectLength = props.subject.length
  let teacherNameLength = props.teacherName.length

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
td {
  text-align: center;
  width: 160px;
  height: 90px;
  font-weight: bold;
}
.lesson-holiday-cell {
  background-color: #f4c9c9;
}
.lesson-cell-box {
  margin: 5px;
}
</style>
