<template>
  <register-modal-base class="modal" :is-shown="props.isShown">
    <div>
      <div class="register-base">
        <form action="" method="get" class="form-example">
          <div class="subject-teacher-form">
            <label for="subject">科目：</label>
            <input type="text" name="subject" id="subject" required />
          </div>
          <div class="subject-teacher-form">
            <label for="teacher">教師：</label>
            <input type="text" name="teacher" id="teacher" required />
          </div>
          <div class="cancel-register-form">
            <input @click="onclick" type="reset" value="キャンセル" /><input type="submit" value="登録" />
          </div>
        </form>
      </div>
    </div>
  </register-modal-base>
</template>

<script setup>
import { ref } from 'vue'
import ModalBase from './modal-base.vue'

const date = ref()

const props = defineProps({
  isShown: false,
})

const isShown = ref(false)

const emit = defineEmits()

function onclick() {
  isShown.value = !isShown.value
}

watch(date, () => {
  console.log(date.value[0])
  console.log(date.value)
  if (!date.value) {
    return
  }
  emit('update:value', date.value)
})

watch(props.isShown, () => {
  isShown.value = props.isShown
})
</script>

<style lang="scss" scoped>
div {
  padding: 1%;
}

.register-base {
  background-color: white;
  width: 600px;
  height: 450px;
}

.cancel-button {
  color: #5160ae;
  font-size: 24px;
  text-align: center;
  bottom: 10px;
}

.register-button {
  color: white;
  font-size: 24px;
  text-align: center;
}

.subject-teacher-form {
  font-size: 24px;
  position: relative;
}

.cancel-register-form {
  font-size: 24px;
  padding: 10px 20px;
  margin: 0 10px;
  border-radius: 10px;
}
</style>
