<template>
  <modal-base :is-shown="props.isShown">
    <div>
      <VueDatePicker
        class="calendar"
        id="auto"
        v-model="date"
        locale="jp"
        :min-date="minDate"
        :max-date="maxDate"
        prevent-min-max-navigation
        :enable-time-picker="false"
        :[selectionType]="''"
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
import { getYear } from 'date-fns'

const date = ref()
let minDate = computed(() => new Date(2014, 11, 29))
const maxDate = computed(() => new Date(getYear(new Date()) + 1, 11, 31))
const props = defineProps({
  isShown: false,
  selectionType: {
    type: String,
    default: () => 'week-picker',
    validator: (value) => ['week-picker', 'range'].includes(value),
  },
})

if (props.selectionType === 'range') {
  minDate = computed(() => new Date(2015, 0, 1))
}

const emit = defineEmits()

watch(date, () => {
  if (!date.value) {
    return
  }
  console.log(date.value)
  if (props.selectionType === 'week-picker') {
    emit('update:value', date.value[0])
  } else {
    emit('update:value', date.value)
  }
})
</script>

<style lang="scss" scoped>
div {
  margin: 6px 2.5px;
}
@media only screen and (max-width: 767px) {
  div {
    margin: 6px 9px 6px 3px;
  }
}
</style>
