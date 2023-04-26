<template>
  <td class="lesson-cell horizontal-writing" :class="{ 'lesson-holiday-cell': isHoliday }">
    <div>
      <button>
        <div class="register-button">登</div>
      </button>
      <button>
        <div class="delete-button">消</div>
      </button>
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

.register-button {
  font-size: 15px;
  background: #15ff00;
}

.delete-button {
  font-size: 15px;
  background: #fc01ca;
}
</style>
