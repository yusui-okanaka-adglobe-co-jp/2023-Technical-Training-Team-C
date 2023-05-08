<template>
  <modal-base class="modal" :is-shown="props.isShown">
    <div>
      <div class="register-base">
        <form class="form-example" @submit="registerform">
          <div class="register-modal-header">{{ props.dayOfWeek }}曜{{ props.period }}時間目</div>
          <div class="subject-form">
            <label for="subject">科目：</label>
            <input type="text" class="subject-input" name="subject" id="subject" maxlength="10" required />
          </div>
          <div class="teacher-form">
            <label for="teacher">教師：</label>
            <input type="text" class="teacher-input" name="teacher" id="teacher" maxlength="10" required />
          </div>

          <button class="usual-button cancel-button" @click.stop="isShown = false">キャンセル</button>
          <button class="unusual-button register-button">登録</button>
        </form>
      </div>
    </div>
  </modal-base>
</template>

<script lang="ts" setup>
import { ref } from 'vue'
import ModalBase from './modal-base.vue'

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

const emit = defineEmits<ModalBaseEmit>()

function registerform(e: Event) {
  e.preventDefault()
  e.target
  if (!(e.target instanceof HTMLFormElement)) return
  e.target.elements
  const subject = e.target.elements.namedItem('subject')
  if (!(subject instanceof HTMLInputElement)) return

  const teacher = e.target.elements.namedItem('teacher')
  if (!(teacher instanceof HTMLInputElement)) return

  emit('submit', { subject: subject.value, teacher: teacher.value })
}
</script>

<style lang="scss" scoped>
div {
  margin: 6px 3px;
}

.register-base {
  background-color: white;
  width: 600px;
  height: 450px;
}

.register-modal-header {
  font-size: 24px;
  text-align: center;
  padding-top: 12px;
}
.cancel-button {
  color: #5160ae;
  font-size: 24px;
  text-align: center;
  margin-left: 64px;
  margin-top: 104px;
}

.register-button {
  color: white;
  font-size: 24px;
  text-align: center;
  margin-left: 152px;
}

.subject-form {
  font-size: 24px;
  position: relative;
  margin-left: 108px;
  margin-top: 100px;
}

.teacher-form {
  font-size: 24px;
  position: relative;
  margin-left: 108px;
  margin-top: 40px;
}
.cancel-register-form {
  font-size: 24px;
  padding: 10px 20px;
  margin: 0 10px;
  border-radius: 10px;
}

.subject-input {
  border: 1px solid black;
}

.teacher-input {
  border: 1px solid black;
}
</style>
