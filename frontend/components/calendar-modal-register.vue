<template>
  <modal-base class="modal" :is-shown="props.isShown">
    <div>
      <VueDatePicker
        class="calendar"
        id="auto"
        v-model="date"
        locale="jp"
        :format="format"
        :min-date="minDate"
        :max-date="maxDate"
        prevent-min-max-navigation
        inline
        auto-apply
        range
      />
    </div>
  </modal-base>
</template>

<script setup>
import VueDatePicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
import { ref } from 'vue'
import { addMonths, getMonth, getYear, subMonths } from 'date-fns'
import ModalBase from './modal-base.vue'

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
