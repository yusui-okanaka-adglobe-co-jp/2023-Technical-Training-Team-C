<template>
  <td class="lesson-cell horizontal-writing" :class="{ 'lesson-holiday-cell': isHoliday }">
    <div class="register-buttons">
      <button class="register-modal-button" @click="onclick"><div class="abc">登</div></button>
      <subject-teacher-register-modal :is-shown="isShown" @update:value="selectDate"> </subject-teacher-register-modal>

      <button class="delete-button">消</button>
    </div>
    <p class="lesson-cell-box" :class="[fontSizeClass('subject')]">{{ props.subject }}</p>
    <p class="lesson-cell-box" :class="[fontSizeClass('teacher')]">{{ props.teacherName }}</p>
  </td>
</template>

<script lang="ts" setup>
const isShown = ref(false)

function onclick() {
  isShown.value = !isShown.value
}

const props = defineProps({
  subject: {
    type: String,
    default: () => '',
  },
  teacherName: {
    type: String,
    default: () => '',
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

.register-buttons {
  text-align: right;
  text-align: top;
  // vertical-align: top;
  margin-bottom: auto;
}

.abc {
  vertical-align: top;
}
.register-modal-button {
  font-size: 16px;
  background: #03ff36;
}

.delete-button {
  font-size: 16px;
  background: #fc01ca;
}
</style>
