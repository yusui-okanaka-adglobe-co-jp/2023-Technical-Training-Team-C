<template>
  <default-layout page-name="教師用ページ">
    <!-- html記述場所 -->
    <TimetableComponent :timetables="timetables"></TimetableComponent>
  </default-layout>
</template>

<script lang="ts" setup>
import { Timetable } from '~~/types/response/timetablesAcquireResponse'
/* 検証用オブジェクト */
const timetables: Timetable[] = [
  {
    date: '2023-04-17',
    dayOfWeek: 1,
    isHoliday: false,
    lessons: [
      {
        subject: '国語',
        teacher: '佐藤',
      },
      {
        subject: '数学',
        teacher: '鈴木鈴木',
      },
      {
        subject: '理科',
        teacher: '高橋高橋高橋',
      },
      {
        subject: '社会',
        teacher: '田中田中田中田中',
      },
      {
        subject: '音楽',
        teacher: '伊藤伊藤伊藤伊藤伊藤',
      },
      {
        subject: '道徳',
        teacher: '中村',
      },
    ],
  },
  {
    date: '2023-04-18',
    dayOfWeek: 2,
    isHoliday: false,
    lessons: [
      {
        subject: '数学数学数学',
        teacher: '鈴木',
      },
      {
        subject: '国語国語国語',
        teacher: '佐藤佐藤',
      },
      {
        subject: '理科理科理科',
        teacher: '高橋高橋高橋',
      },
      {
        subject: '社会社会社会',
        teacher: '田中田中田中田中',
      },
      {
        subject: '体育体育体育',
        teacher: '大林大林大林大林大林',
      },
      {
        subject: '',
        teacher: '',
      },
    ],
  },
  {
    date: '2023-04-19',
    dayOfWeek: 3,
    isHoliday: false,
    lessons: [
      {
        subject: '国語国語国語国語国語',
        teacher: '佐藤',
      },
      {
        subject: '数学数学数学数学数学',
        teacher: '鈴木鈴木',
      },
      {
        subject: '理科理科理科理科理科',
        teacher: '高橋高橋高橋',
      },
      {
        subject: '社会社会社会社会社会',
        teacher: '田中田中田中田中',
      },
      {
        subject: '音楽音楽音楽音楽音楽',
        teacher: '伊藤伊藤伊藤伊藤伊藤',
      },
      {
        subject: '',
        teacher: '',
      },
    ],
  },
  {
    date: '2023-04-20',
    dayOfWeek: 4,
    isHoliday: true,
    holidayTitle: '○○の日',
  },
  {
    date: '2023-04-21',
    dayOfWeek: 5,
    isHoliday: true,
    holidayTitle: '○○○○○の日',
  },
  {
    date: '2023-04-22',
    dayOfWeek: 6,
    isHoliday: true,
    holidayTitle: '天皇誕生日 振替休日',
  },
  {
    date: '2023-04-23',
    dayOfWeek: 0,
    isHoliday: false,
    lessons: [
      {
        subject: '国語',
        teacher: '佐藤',
      },
      {
        subject: '数学',
        teacher: '鈴木',
      },
      {
        subject: '理科',
        teacher: '高橋',
      },
      {
        subject: '社会',
        teacher: '田中',
      },
      {
        subject: '音楽',
        teacher: '伊藤',
      },
      {
        subject: '道徳',
        teacher: '斎藤',
      },
    ],
  },
]
</script>

<style scoped lang="scss"></style>
