<template>
  <default-layout page-name="ログイン画面">
    <div class="container board-color">
      <section class="login">
        <div class="inner-title">
          <h1 class="title font-size-xl">ログイン</h1>
          <!-- ログイン認証に失敗した場合に表示するエラーメッセージ出力場所 -->
          <p v-if="!isValidPass" :class="style">
            ログインに失敗しました。<br />
            メールアドレス、またはパスワードが間違っています。
          </p>
        </div>
        <form>
          <div class="mail">
            <p class="font-size-s">メールアドレス：</p>
            <input
              type="email"
              required
              name="required"
              placeholder="メールアドレス入力"
              v-model="email"
              :class="Err"
              pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$"
            />
          </div>
          <div class="pass">
            <p class="font-size-s">パスワード：</p>
            <input
              :type="passwordType"
              required
              name="required"
              placeholder="パスワード入力"
              id="passwordInput"
              minlength="8"
              :class="Err"
            />
            <br />
            <input type="checkbox" id="checkPassword" v-model="isChecked" />
            <label for="checkPassword" class="font-size-m">パスワード表示</label>
            <br />
          </div>
          <button class="button main-color font-size-l" @click="onClick">ログインする</button>
          <p class="none">{{ message }}</p>
        </form>
      </section>
    </div>
  </default-layout>
</template>

<script lang="ts" setup>
// パスワード表示切り替え部分
const isChecked = ref(false)
const passwordType = computed(function () {
  if (isChecked.value) {
    return 'text'
  }
  return 'password'
})

// ボタンクリック時のバリデーションチェック
const message = ref('')
const email = ref('')
let style = ref('none')
let Err = ref('nonebox')
const isValidEmail = computed(() => {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)
})
const isValidPass = computed(() => {
  return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(email.value)
})

const onClick = () => {
  message.value = 'BottonClicked'
  if (isValidEmail.value) {
    // フォームを送信する処理
  } else {
    // バリデーションエラーを処理する処理
    style = ref('red')
    Err = ref('errbox')
  }
  if (isValidPass.value) {
    // フォームを送信する処理
  } else {
    // バリデーションエラーを処理する処理
    style = ref('red')
    Err = ref('errbox')
  }
}
</script>

<style scoped lang="scss">
.container {
  width: 450px;
  height: 600px;
  margin: 64px auto 0;
  padding-top: 32px;
}
.inner-title {
  height: 110px;
  p {
    margin-top: 16px;
    text-align: center;
  }
}
.title {
  font-weight: bold;
  text-align: center;
}

form {
  width: 250px;
  margin: 24px auto 0;
  text-align: center;
  p {
    text-align: left;
  }
  input {
    width: 250px;
    padding: 9px 12px;
    border: 1px solid #000000;
  }
  button {
    text-align: center;
    transition: 0.3s;
  }
  button:hover {
    transform: scale(1.1);
  }
}
.mail {
  height: 100px;
}
.pass {
  margin-top: 32px;
  height: 136px;
}
#checkPassword {
  width: auto;
  margin-top: 42.5px;
}
.button {
  margin-top: 24px;
  color: #ffffff;
  padding: 18px 15.5px;
  font-weight: bold;
  border-radius: 10px;
}
.none {
  color: #ffffff;
}
.red {
  color: red;
}
.errbox {
  background-color: rgba(255, 229, 229, 1);
}
.nonebox {
  background-color: #ffffff;
}
</style>
