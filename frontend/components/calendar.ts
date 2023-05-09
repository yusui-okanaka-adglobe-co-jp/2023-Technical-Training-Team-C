import { ref } from 'vue'
import { getYear } from 'date-fns'
export default function () {
  const date = ref()

  const minDate = computed(() => new Date(2015, 0, 5))
  const maxDate = computed(() => new Date(getYear(new Date()) + 1, 11, 31))

  const props = defineProps({
    isShown: false,
  })

  const emit = defineEmits()

  watch(date, () => {
    if (!date.value) {
      return
    }
    emit('update:value', date.value)
  })

  watch(props.isShown, () => {
    isShown.value = props.isShown
  })
}
