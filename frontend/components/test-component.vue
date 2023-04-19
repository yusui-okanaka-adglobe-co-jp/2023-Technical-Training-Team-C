<template>
  <table>
    <thead>
      <tr>
        <th class="vertical-head"></th>
        <th class="date-cell">日付</th>
        <th class="date-cell">日付</th>
        <th class="date-cell">日付</th>
        <th class="date-cell">日付</th>
        <th class="date-cell">日付</th>
        <th class="date-cell">日付</th>
        <th class="date-cell">日付</th>
      </tr>
    </thead>
    <thead>
      <tr>
        <th class="dayOfWeek-cell"></th>
        <th class="dayOfWeek-cell">月</th>
        <th class="dayOfWeek-cell">火</th>
        <th class="dayOfWeek-cell">水</th>
        <th class="dayOfWeek-cell">木</th>
        <th class="dayOfWeek-cell">金</th>
        <th class="dayOfWeek-cell">土</th>
        <th class="dayOfWeek-cell">日</th>
      </tr>
    </thead>
    <tr>
      <td>1</td>
      <TimetableLesson :subject="subject" :teacher-name="teacherName"></TimetableLesson>
      <td>国語 <br />佐藤</td>
      <td>国語 <br />佐藤</td>
      <td>国語 <br />佐藤</td>
      <td>国語 <br />佐藤</td>
      <td>国語 <br />佐藤</td>
      <td></td>
    </tr>
    <tr>
      <td>2</td>
      <td>数学 <br />鈴木</td>
      <td>数学 <br />鈴木</td>
      <td>数学 <br />鈴木</td>
      <td>数学 <br />鈴木</td>
      <td>数学 <br />鈴木</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>3</td>
      <td class="timetable-cell"></td>
      <td>英語 <br />佐々木</td>
      <td>英語 <br />佐々木</td>
      <td>英語 <br />佐々木</td>
      <td>英語 <br />佐々木</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>4</td>
    </tr>
    <tr>
      <td>5</td>
    </tr>
    <tr>
      <td>6</td>
    </tr>
  </table>
</template>

<script lang="ts" setup>
const subject = '美術美術美美術美術美美術美術美'
const teacherName = '橋本'
</script>

<style lang="scss" vscoped>
table {
  border-collapse: collapse;
  border: 1px solid #333;
  box-sizing: border-box;
  table-layout: fixed;
  width: 1200px;
  height: 660px;
  padding: 0;
}

td,
th,
tr {
  border: 1px solid #333;
  box-sizing: border-box;

  word-break: break-word;
  /*border-spacing: 0; :-*/
}
.date-cell {
  width: 160px;
  height: 80px;
}
.dayOfWeek-cell {
  width: 180px;
  height: 40px;
}
.period-cell {
  width: 80px;
  height: 90px;
}
.vertical-head {
  width: 80px;
  height: 80px;
}
.timetable-cell {
}
.font-size-M {
  font-size: 18px;
}

.font-size-L {
  font-size: 24px;
}
.font-size-XL {
  font-size: 36px;
}
</style>
