import { Time, Lesson } from '~~/types/request/timetablesRegisterRequest'

const time = ref<Time>()
const lessons = ref<Lesson[]>([])

export const useTimetables = () => {
  return {
    time,
    lessons,
  }
}
