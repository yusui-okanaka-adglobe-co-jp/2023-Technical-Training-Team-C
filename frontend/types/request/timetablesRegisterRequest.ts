export interface Lesson {
  subject: string
  teacher: string
  dayOfWeek: number
  period: number
  isClear: boolean
}

export interface Time {
  start: string
  end: string
}
