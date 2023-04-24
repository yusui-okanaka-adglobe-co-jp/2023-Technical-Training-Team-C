export interface ITimetable {
  date: string
  dayOfWeek: number
  isHoliday: boolean
  lessons?: Array<ILesson>
  holidayTitle?: string
}

interface ILesson {
  subject: string
  teacher: string
}
