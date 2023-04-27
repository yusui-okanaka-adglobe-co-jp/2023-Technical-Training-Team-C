export interface TimetableRegister {
  dayOfWeek: number
  lessons?: Array<Lesson>
}
interface Lesson {
  subject: string
  teacher: string
}
