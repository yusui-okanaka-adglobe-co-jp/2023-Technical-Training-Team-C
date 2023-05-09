<template>
  <modal-base class="modal" :is-shown="props.isShown">
    <div>
      <div class="register-base board-color">
        <form class="form-example" @submit="submit">
          <div class="register-modal-header font-size-l">{{ props.dayOfWeek }}曜{{ props.period }}時間目</div>
          <div class="subject-form font-size-l">
            <label for="subject">科目：</label>
            <input type="text" class="subject-input" name="subject" id="subject" maxlength="10" required />
          </div>
          <div class="teacher-form font-size-l">
            <label for="teacher">教師：</label>
            <input type="text" class="teacher-input" name="teacher" id="teacher" maxlength="10" required />
          </div>

          <button class="usual-button cancel-button font-size-l main-color" @click.stop="isShown = false">
            キャンセル
          </button>
          <button class="unusual-button register-button font-size-l">登録</button>
        </form>
      </div>
    </div>
  </modal-base>
</template>

<script lang="ts" setup>
import { ref } from 'vue'
import ModalBase from './modal-base.vue'

const subject = ref('')
const teacher = ref('')

export interface Submit {
  subject: string
  teacher: string
}

interface ModalBaseProps {
  isShown: boolean
  dayOfWeek: string
  period: number
}

interface ModalBaseEmit {
  (e: 'submit', value: Submit): void
}

const props = withDefaults(defineProps<ModalBaseProps>(), {
  isShown: false,
  dayOfWeek: '',
  period: 0,
})

const emit = defineEmits(['update:subject', 'update:teacher'])
const updateSubject = ref('')
const updateTeacher = ref('')
console.log()

function submit(submit: Submit) {
  updateSubject.value = submit.subject
  updateTeacher.value = submit.teacher
  console.log(updateSubject.value)
  emit('update:subject', updateSubject.value)
  emit('update:teacher', updateTeacher.value)
}
// const emit = defineEmits<ModalBaseEmit>()

// function registerform(e: Event) {
//   e.preventDefault()
//   e.target
//   if (!(e.target instanceof HTMLFormElement)) return
//   e.target.elements
//   const subject = e.target.elements.namedItem('subject')
//   if (!(subject instanceof HTMLInputElement)) return

//   const teacher = e.target.elements.namedItem('teacher')
//   if (!(teacher instanceof HTMLInputElement)) return

//   emit('submit', { subject: subject.value, teacher: teacher.value })
// }
</script>

<style lang="scss" scoped>
div {
  margin: 6px 3px;
}

.register-base {
  width: 600px;
  height: 450px;
}

.register-modal-header {
  text-align: center;
  padding-top: 12px;
}
.cancel-button {
  text-align: center;
  margin-left: 64px;
  margin-top: 104px;
}

.register-button {
  color: white;
  text-align: center;
  margin-left: 152px;
}

.subject-form {
  position: relative;
  margin-left: 108px;
  margin-top: 100px;
}

.teacher-form {
  position: relative;
  margin-left: 108px;
  margin-top: 40px;
}
.subject-input {
  border: 1px solid black;
}

.teacher-input {
  border: 1px solid black;
}
</style>
