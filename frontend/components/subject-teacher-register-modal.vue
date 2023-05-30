<template>
  <modal-base :is-shown="props.isShown" @on-close="onClose">
    <div>
      <div class="register-base board-color">
        <form class="form-example" @submit="regist">
          <div class="register-modal-header font-size-l">{{ props.dayOfWeek }}曜{{ props.period }}時間目</div>
          <div class="subject-form font-size-l">
            <label for="subject"
              >科目：
              <input
                type="text"
                v-model="subject"
                class="subject-teacher-input"
                maxlength="10"
                :required="!isClear"
                :disabled="isClear"
                :readonly="isClear"
              />
            </label>
            <div v-if="!isValidSubject" class="font-size-xs red inner-title__err validate">
              科目名を入力してください
            </div>
          </div>
          <div class="teacher-form font-size-l">
            <label for="teacher"
              >教師：
              <input
                type="text"
                v-model="teacher"
                class="subject-teacher-input"
                maxlength="10"
                :required="!isClear"
                :disabled="isClear"
              />
            </label>
            <div v-if="!isValidTeacher" class="font-size-xs red inner-title__err validate">
              教師名を入力してください
            </div>
          </div>
          <div class="clear-checkbox-set font-size-m">
            <label for="check1">
              <input type="checkbox" id="check1" class="clear-checkbox" v-model="isClear" />
              授業削除
            </label>
          </div>
          <button type="button" class="usual-button cancel-button" @click.stop="onClose">
            <div class="font-size-l">キャンセル</div>
          </button>
          <button type="button" class="unusual-button register-button" @click="regist">
            <div class="font-size-l">登録</div>
          </button>
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
  isClear: boolean
}

interface ModalBaseProps {
  isShown: boolean
  dayOfWeek: string
  period: number
}

defineExpose({
  clear() {
    subject.value = ''
    teacher.value = ''
    isClear.value = false
    console.log('clear')
  },
})

const subject = ref('')
const teacher = ref('')
const isClear = ref(false)

const isValidSubject = ref(true)
const isValidTeacher = ref(true)

const props = withDefaults(defineProps<ModalBaseProps>(), {
  isShown: false,
  dayOfWeek: '',
  period: 0,
})

const emit = defineEmits(['submit', 'onClose'])

function regist(e: Event) {
  console.log('regist')
  e.preventDefault()
  isValidSubject.value = subject.value.length !== 0 || isClear.value
  isValidTeacher.value = teacher.value.length !== 0 || isClear.value

  if (isClear.value) {
    subject.value = ''
    teacher.value = ''
    emit('submit', { subject: subject.value, teacher: teacher.value, isClear: isClear.value })
  } else {
    if (isValidSubject.value && isValidTeacher.value) {
      emit('submit', { subject: subject.value, teacher: teacher.value, isClear: isClear.value })
    }
  }
}

function onClose() {
  emit('onClose')
}

watch(
  () => isClear.value,
  () => {
    subject.value = ''
    teacher.value = ''
  }
)
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
  padding-top: 2%;
}

.clear-checkbox-set {
  text-align: center;
  margin-top: 8%;
}
.clear-checkbox {
  transform: scale(2);
  margin-right: 2%;
}
.cancel-button {
  text-align: center;
  margin-left: 10%;
  margin-top: 5%;
}

.validate {
  margin-left: 5%;
  position: fixed;
}
.register-button {
  text-align: center;
  margin-left: 25%;
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
.subject-teacher-input {
  border: 1px solid black;

  &:disabled {
    background: #a9a9a9;
  }
}
</style>
