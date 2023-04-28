<template>
  <modal-base class="modal" :is-shown="props.isShown">
    <div>
      <VueDatePicker
        class="calendar"
        id="auto"
        v-model="date"
        locale="jp"
        :min-date="minDate"
        :max-date="maxDate"
        prevent-min-max-navigation
        week-picker
        inline
        auto-apply
      />
    </div>
  </modal-base>
</template>

<script setup>
import ModalBase from './modal-base.vue'
import VueDatePicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
import { ref } from 'vue'
import { addMonths, getMonth, getYear, subMonths } from 'date-fns'

const date = ref()

const minDate = computed(() => new Date(2015, 0, 5))
const maxDate = computed(() => addMonths(new Date(getYear(new Date()) + 1, 11, 25), 0))

const props = defineProps({
  isShown: false,
})

const emit = defineEmits()

watch(date, () => {
  if (!date.value) {
    return
  }
  emit('update:value', date.value[0])
})
</script>

<style lang="scss" scoped>
div {
  margin: 6px 2.5px;
}
</style>
