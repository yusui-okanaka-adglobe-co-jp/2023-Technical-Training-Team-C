<template>
  <td class="lesson-cell horizontal-writing">
    <div class="cell">
      <div class="register-buttons">
        <button class="register-modal-button font-size-m" @click="onclick">登</button>
        <subject-teacher-register-modal
          :is-shown="isShown"
          @submit="submit"
          :dayOfWeek="props.dayOfWeek"
          :period="props.period"
        >
        </subject-teacher-register-modal>
        <button class="delete-button font-size-m" @click="deleteClass">消</button>
      </div>
      <div>
        <p class="lesson-cell-box" :class="[fontSizeClass('subject')]">{{ updateSubject }}</p>
        <p class="lesson-cell-box" :class="[fontSizeClass('teacher')]">{{ updateTeacher }}</p>
      </div>
    </div>
  </td>
</template>

<script lang="ts" setup>
import { ref } from 'vue'
import { Submit } from './subject-teacher-register-modal.vue'

const isShown = ref(false)

function onclick() {
  isShown.value = !isShown.value
  console.log('onclick')
}

function deleteClass() {
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

const emit = defineEmits(['update:subject', 'update:teacherName'])

const updateSubject = ref('')
const updateTeacher = ref('')
function submit(submit: Submit) {
  updateSubject.value = submit.subject
  updateTeacher.value = submit.teacher
  emit('update:subject', updateSubject.value)
  emit('update:teacherName', updateTeacher.value)
  isShown.value = false
}

/* 科目名／教師名の文字の大きさを決める */
function fontSizeClass(msg: string) {
  const subjectLength = updateSubject.value.length
  const teacherNameLength = updateTeacher.value.length

  if (msg == 'subject') {
    if (subjectLength >= 9) {
      return 'font-size-xs'
    } else if (subjectLength >= 7) {
      return 'font-size-s'
    } else if (subjectLength >= 5) {
      return 'font-size-m'
    }
    return 'font-size-l'
  }
  if (teacherNameLength >= 9) {
    return 'font-size-xs'
  }
  return 'font-size-s'
}
</script>

<style lang="scss">
@import '../assets/scss/timetable.scss';

.cell {
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
  background: #03ff36;
}

.delete-button {
  background: #fc01ca;
}
</style>
