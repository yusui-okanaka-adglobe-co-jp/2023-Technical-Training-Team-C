<template>
  <td class="lesson-cell horizontal-writing">
    <div class="cell">
      <div class="register-buttons">
        <button class="register-modal-button" @click="onclick">登</button>
        <subject-teacher-register-modal
          :is-shown="isShown"
          @submit="submit"
          :dayOfWeek="props.dayOfWeek"
          :period="props.period"
        >
        </subject-teacher-register-modal>
        <button class="delete-button" @click="deleteclick">消</button>
      </div>
      <div>
        <p class="lesson-cell-box" :class="[fontSizeClass('subject')]">{{ updateSubject }}</p>
        <p class="lesson-cell-box" :class="[fontSizeClass('teacher')]">{{ updateTeacher }}</p>
      </div>
    </div>
  </td>
</template>

<script lang="ts" setup>
import { eachMinuteOfInterval } from 'date-fns'
// import { Submit } from './subject-teacher-register-modal.vue'

const isShown = ref(false)

function onclick() {
  isShown.value = !isShown.value
}

function deleteclick() {
  updateSubject.value = ''
  updateTeacher.value = ''
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
  dayOfWeek: {
    type: String,
    required: true,
  },
  period: {
    type: Number,
    required: true,
  },
})

const emit = defineEmits()

const updateSubject = ref('')
const updateTeacher = ref('')
function submit(submit: Submit) {
  updateSubject.value = submit.subject
  updateTeacher.value = submit.teacher

  // emit('submit', { subject: updateSubject.value, teacher: updateTeacher })
  isShown.value = false
}

/* 科目名／教師名の文字の大きさを決める */
function fontSizeClass(msg: string) {
  const subjectLength = updateSubject.value.length
  const teacherNameLength = updateTeacher.value.length
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

.cell {
  // position: relative;
  display: flex;
  width: 100%;
  height: 100%;
  flex-direction: column;
}

.register-buttons {
  display: flex;
  flex-direction: row;
  justify-content: flex-end;
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
