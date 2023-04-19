<template>
  <td>
    <div>
      <span :style="fontSize">{{ props.subject }}</span
      ><br />
      <!-- <span :class="{ fontSizeTeacher: isLength  }">{{ props.teacherName }}</span> -->
      <span :class="[fontSizeClass()]">{{ props.teacherName }}</span>
    </div>
  </td>
</template>

<script lang="ts" setup>
const props = defineProps({
  subject: {
    type: String,
    required: true,
  },
  teacherName: String,
})
function fontSizeClass() {
  let length = props.subject.length
  if (length >= 17) {
    return 'fontSizeTeacher'
  }
  return 'fontSizeTeacher2'
}

let fontSize = { fontSize: '36px' }
if ((props.subject?.length ?? 0) >= 17) {
  fontSize = { fontSize: '14px' }
} else if ((props.subject?.length ?? 0) >= 7) {
  fontSize = { fontSize: '18px' }
} else if ((props.subject?.length ?? 0) >= 5) {
  fontSize = { fontSize: '24px' }
}

console.log(props.subject?.length)

let isLength = (props.subject?.length ?? 0) >= 20
console.log(isLength)
</script>
<style lang="scss">
td {
  box-sizing: border-box;
  width: 160px;
  height: 90px;
  line-height: 1.5;
  word-break: break-word;
}

.fontSizeTeacher {
  font-size: 54px;
}
.fontSizeTeacher2 {
  font-size: 36px;
}
</style>
