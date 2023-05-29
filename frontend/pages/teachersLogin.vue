<template>
  <default-layout page-name="ログイン画面">
    <div class="button-area">
      <button class="button-font-color usual-button font-size-m" @click="goToStudentPage">生徒用画面確認</button>
    </div>
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
              :class="boxColor"
              v-model="formData.password"
              pattern="^[a-zA-Z\d]{8,100}$"
              title="パスワードは半角英数字で8文字以上入力してください。"
            />
            <label for="check-password" class="font-size-m">
              <input type="checkbox" id="check-password" v-model="isChecked" class="inner-form__pass__check-password" />
              パスワード表示
            </label>
          </div>
          <button
            type="button"
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
definePageMeta({
  middleware: 'auth',
})
import { messagesResponse } from '~~/types/response/messagesResponse'

//生徒用画面遷移
function goToStudentPage() {
  window.open('/studentHome', '_blank', 'noreferrer')
}

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

const config = useRuntimeConfig()
const route = useRouter()

// ボタンクリック時の動作
const onClick = async () => {
  // バリデーションチェック
  isValidEmail.value = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)
  isValidPass.value = /^[a-zA-Z\d]{8,100}$/.test(formData.password)

  if (isValidEmail.value && isValidPass.value) {
    // 入力時のバリデーションチェック成功
    // api取得の処理
    try {
      const response = await $fetch<messagesResponse>('/api/teachersLogin', {
        baseURL: config.public.apiUrl,
        method: 'POST',
        credentials: 'include',
        body: formData,
      })
      if (response.messages[0] === 'success') {
        // response:success
        // ページ遷移の処理
        route.push('/home')
        return
      } else {
        // response:failure
        boxColor.value = 'errbox'
        isValidPass.value = false
      }
    } catch (e) {
      // 例外処理
      boxColor.value = 'errbox'
      isValidPass.value = false
      throw createError({
        statusCode: 500,
        message: 'Error fetching data',
      })
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
  margin: 0 auto;
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

//生徒用画面ボタンエリア
.button-area {
  height: 64px;
  text-align: right;
  margin-right: min(5%, 20px);
}
</style>
