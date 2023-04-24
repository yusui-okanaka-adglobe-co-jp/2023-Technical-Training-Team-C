export interface Timetable {
  date: string
  dayOfWeek: number
  isHoliday: boolean
  lessons?: Array<Lesson>
  holidayTitle?: string
}

interface Lesson {
  subject: string
  teacher: string
}
