import { Time, Lesson } from '~~/types/request/timetablesRegisterRequest'

const time = ref<Time>()
const lessons = ref<Lesson[]>([])

function clear() {
  lessons.value = []
  time.value = { start: '', end: '' }
}

export const useTimetables = () => {
  return {
    time,
    lessons,
    clear,
  }
}
