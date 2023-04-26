import ModalBase from './modal-base.vue'; import ModalBase from './modal-base.vue';

<template>
  <div>
    <VueDatePicker
      class="calendar"
      v-model="date"
      locale="jp"
      :format="format"
      :min-date="minDate"
      :max-date="maxDate"
      prevent-min-max-navigation
      range
    />
  </div>
</template>

<script setup>
import VueDatePicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
import { ref } from 'vue'
import { addMonths, getMonth, getYear, subMonths } from 'date-fns'

const date = ref()
const format = (date) => {
  // console.log(date.value)
}

const minDate = computed(() => subMonths(new Date(2015, 0, 5), 0))
const maxDate = computed(() => addMonths(new Date(getYear(new Date()) + 1, 11, 25), 0))

const props = defineProps({
  isShown: false,
})

const isShown = ref(false)

const emit = defineEmits()

watch(date, () => {
  console.log(date.value[0])
  if (!date.value) {
    return
  }
  emit('update:value', date.value[0])
})

watch(props.isShown, () => {
  isShown.value = props.isShown
})
</script>

<style lang="scss" scoped>
div {
  padding: 1%;
}

.calendar {
  position: fixed;
  left: 200px;
}

$dp__button_height: 100px !important;

@import '@vuepic/vue-datepicker/src/VueDatePicker/style/main.scss';
</style>
