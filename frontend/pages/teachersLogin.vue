<template>
  <default-layout page-name="ログイン画面">
    <div class="container board-color">
      <section class="login">
        <div class="inner-title">
          <h1 class="inner-title__login font-size-xl">ログイン</h1>
          <!-- ログイン認証に失敗した場合に表示するエラーメッセージ出力場所 -->
          <p v-if="!isValidPass" class="red inner-title__err">
            ログインに失敗しました。<br />
            メールアドレス、またはパスワードが間違っています。
          </p>
        </div>
        <!-- フォーム　ここから -->
        <form class="inner-form">
          <div class="inner-form__mail">
            <p class="font-size-s inner-form__text">メールアドレス：</p>
            <input
              class="inner-form__input"
              type="email"
              required
              placeholder="メールアドレス入力"
              v-model="formData.email"
              :class="boxColor"
              pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$"
            />
          </div>
          <div class="inner-form__pass">
            <p class="font-size-s inner-form__text">パスワード：</p>
            <input
              class="inner-form__input"
              :type="passwordType"
              required
              placeholder="パスワード入力"
              minlength="8"
              :class="boxColor"
              v-model="formData.password"
              pattern="^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$/"
            />
            <br />
            <label for="check-password" class="font-size-m">
              <input type="checkbox" id="check-password" v-model="isChecked" class="inner-form__pass__check-password" />
              パスワード表示
            </label>
          </div>
          <button
            type="submit"
            class="inner-form__login-button main-color font-size-l"
            @click="onClick"
            formmethod="post"
          >
            ログインする
          </button>
        </form>
        <!-- フォーム　ここまで -->
      </section>
    </div>
  </default-layout>
</template>

<script lang="ts" setup>
import { TeachersLoginResponse } from '~~/types/response/TeachersLoginResponse'
// パスワード表示切り替え部分
const isChecked = ref(false)
const passwordType = computed(function () {
  if (isChecked.value) {
    return 'text'
  }
  return 'password'
})

const boxColor = ref('nonebox')
const isValidEmail = ref(true)
const isValidPass = ref(true)
const formData = {
  email: '',
  password: '',
}
// ボタンクリック時の動作
const onClick = async () => {
  // バリデーションチェック
  isValidEmail.value = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)
  isValidPass.value = /^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$/.test(formData.password)
  if (isValidEmail.value) {
    if (isValidPass.value) {
      // 入力時のバリデーションチェック成功
      // api取得の処理
      const { data: response } = await useFetch<TeachersLoginResponse>('http://localhost:8000/api/teachersLogin', {
        method: 'POST',
        body: formData,
      })
      // response:success
      if (response.value?.messages[0] === 'success') {
        // ページ遷移の処理
        navigateTo({ path: '/home' })
      } else {
        // response:success以外
        boxColor.value = 'errbox'
      }
    } else {
      // バリデーションエラーの処理
      boxColor.value = 'errbox'
    }
  } else {
    // バリデーションエラーの処理
    boxColor.value = 'errbox'
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
  &__login {
    font-weight: bold;
    text-align: center;
  }
  &__err {
    margin-top: 16px;
    text-align: center;
  }
}

// フォーム
.inner-form {
  width: 250px;
  margin: 24px auto 0;
  text-align: center;
  &__mail {
    height: 100px;
  }
  &__pass {
    margin-top: 32px;
    height: 136px;
    &__check-password {
      width: auto;
      margin-top: 42.5px;
    }
  }
  &__text {
    text-align: left;
  }
  &__input {
    width: 250px;
    padding: 9px 12px;
    border: 1px solid #000000;
  }
  &__login-button {
    text-align: center;
    transition: 0.3s;
    margin-top: 24px;
    color: #ffffff;
    padding: 18px 15.5px;
    font-weight: bold;
    border-radius: 10px;
  }
  &__login-button:hover {
    transform: scale(1.1);
  }
}
// if
.errbox {
  background-color: rgba(255, 229, 229, 1);
}
.nonebox {
  background-color: #ffffff;
}
</style>
