# 目次

- [Git](#git)
  - [ソースコードのダウンロード](#git-clone)
- [Frontend](#frontend)
  - [初期設定](#frontend-initialize)
  - [起動](#frontend-run)
  - [停止](#frontend-stop)
  - [ビルド](#frontend-build)
- [Backend](#backend)
  - [初期設定](#backend-initialize)
  - [起動](#backend-run)
  - [停止](#backend-stop)
- [VSCode](#vscode)
  - [拡張機能のインストール](#vscode-extensions)
- [開発](#develop)
- [pgAdmin の操作方法](#pgadmin)
  - [ログイン](#pgadmin-login)
  - [テーブルの内容を確認する](#pgadmin-show-table)
- [デプロイ](#deploy)

<a id="git"></a>

# Git

<a id="git-clone"></a>

## ソースコードのダウンロード

Ubuntu のターミナルを開き、任意のディレクトリで以下のコマンドを実行します。

```bash
git clone <このリポジトリのURL>
cd <リポジトリ名>
code .
```

`git clone` を行ったディレクトリには、[こちら](https://drive.google.com/drive/folders/117dX2iZ5GDQ6Y5wlSrpGHo6yHKXkMLE4?usp=sharing)から .env ファイルをダウンロードし、それぞれを `frontend` と `backend` ディレクトリに配置してください。  
![image](https://user-images.githubusercontent.com/105618751/218346245-17a5c7c9-e056-4d0f-9413-c482a9c000e5.png)

VSCode 起動後は[拡張機能のインストール](#vscode-extensions)を行ってください。  
インストール後は VSCode を閉じてしまって問題ありません。

<a id="frontend"></a>

# Frontend

<a id="frontend-initialize"></a>

## 初期設定

Ubuntu ターミナルで以下のコマンドを実行し、起動に必要なパッケージのインストールを行います。

```bash
# nvm(Node.js バージョン管理ツール) のインストール
curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash
source ~/.profile
# バージョン確認
nvm -v
# command not found と表示される場合、Ubuntu ターミナルの再起動を行う

# Node.js のインストール
nvm install --lts
# バージョン確認
node -v

# Yarn のインストール
npm install -g yarn
# バージョン確認
yarn -v
```

Ubuntu ターミナルで以下のコマンドを実行し、VSCode を起動します。

```bash
code frontend/
```

VSCode 起動後は[拡張機能のインストール](#vscode-extensions)を行ってください。

<a id="frontend-run"></a>

## 起動

VSCode で `Shift + Ctrl + @` を押下してターミナルを表示し、以下のコマンドを実行してください。

```bash
yarn install && yarn dev
```

起動後は以下の URL に接続できますので、実際にアクセスして確認してください。

- http://localhost:3000

<a id="frontend-stop"></a>

## 停止

起動コマンドを入力した VSCode のターミナルで `Ctrl + C` を入力します。

<a id="frontend-build"></a>

## ビルド

ビルドを行うには以下のコマンドを実行してください。

```bash
# ビルドコマンド
yarn build
# ビルド後に実行するコマンド
# Nuxt3 はビルド後に .env を読み込んでくれないため、HOST と PORT は起動時に設定する必要がある
source .env && HOST=$HOST PORT=$PORT node .output/server/index.mjs
```

<a id="backend"></a>

# Backend

<a id="backend-initialize"></a>

## 初期設定

Ubuntu ターミナルで以下のコマンドを実行し、VSCode を起動します。

```bash
code backend/
```

VSCode 起動後は[拡張機能のインストール](#vscode-extensions)を行ってください。

その後 `Shift + Ctrl + @` を押下し、ターミナルを表示して以下のコマンドを実行してください。

```bash
# Composer パッケージの初期化
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
# sail のエイリアス
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

<a id="backend-run"></a>

## 起動

VSCode のターミナルで以下のコマンドを実行します。

```bash
sail up -d
```

起動後は以下の URL に接続できますので、実際にアクセスして確認してください。

- Laravel: http://localhost:8000
- pgAdmin(DB 管理): http://localhost:8080

<a id="backend-stop"></a>

## 停止

VSCode のターミナルで以下のコマンドを実行します。

```bash
sail down
```

<a id="vscode"></a>

# VSCode

<a id="vscode-extensions"></a>

## 拡張機能のインストール

VSCode が起動したら右下に画像のような通知が表示されるため、「インストール」を選択します。  
![image](https://user-images.githubusercontent.com/105618751/212531923-9d03069f-8d93-4ccf-bcc1-bb9d3ddae8a9.png)

> **Note**
>
> ### 通知が表示されない・通知を閉じてしまった場合
>
> 1. `Shift + Ctrl + P` を押下し、テキストボックスに `recommend` と入力します。
> 2. 「拡張機能: ワークスペース フォルダーの推奨事項に拡張機能を追加する」を選択します。
>    ![image](https://user-images.githubusercontent.com/105618751/212533529-977c4078-6d5e-4db8-b7c3-2a3f7892c319.png)
>    - または `Shift + Ctrl + X` を押下し、テキストボックスに `@recommended` と入力します。
>      ![image](https://user-images.githubusercontent.com/105618751/212532098-fb170ed1-fdd8-488b-bbe8-c12eecfb5719.png)
> 3. 表示された拡張機能をすべてインストールしてください。

<a id="develop"></a>

# 開発

以下を参考に開発を行ってください。

- [Nuxt.js の開発について](https://wiki.adglobe.co.jp/doc/vuejsnuxtjs-jsQAbcZvZy)
- [Laravel の開発について](https://wiki.adglobe.co.jp/doc/laravel-Stxl3Ci80z)

[/frontend/pages/sample.vue](http://localhost:3000/sample) に API 通信のサンプルを実装してあるため、こちらも参考程度に目を通しておいてください。

<a id="pgadmin"></a>

# pgAdmin の操作方法

<a id="pgadmin-login"></a>

## ログイン

http://localhost:8080 に接続すると以下の画面が表示されますので、`sail@example.co.jp` 、`password` と入力し、Login ボタンを押下してください。  
言語に関しては日本語を選択していただいて構いませんが、以降の説明は英語ページをもとに行っています。  
![image](https://user-images.githubusercontent.com/105618751/222668299-5eb5931c-2964-4138-9bd7-eb6d46e1bb12.png)

<a id="pgadmin-show-table"></a>

## テーブルの内容を確認する

1. 画面左メニューを以下の通りにたどります。  
    `Servers -> Laravel Sail -> Databases -> backend -> Schemas -> public -> Tables`  
   ![image](https://user-images.githubusercontent.com/105618751/222663594-8fac39cb-80f0-414f-9db6-7c78dd10f7b0.png)
2. 参照したいテーブルで右クリックし、以下の通りに選択します。  
    `View/Edit Data -> All Rows`  
   ![image](https://user-images.githubusercontent.com/105618751/222665066-1cc747d7-2797-4879-bc12-821b0e449608.png)
3. SQL と実行結果が表示されます。  
    絞り込みを行う場合は上部のフィルタボタンを押下し、表示されるウィンドウで条件を入力後、Save ボタンを押下してください。  
   ![image](https://user-images.githubusercontent.com/105618751/222666015-addd56fe-61e0-40a4-9654-63ce9ced5d0b.png)
4. 細かい操作方法に関しては[公式ドキュメント](https://www.pgadmin.org/docs/pgadmin4/latest/index.html)を参照してください。  
   [こちら](https://itsakura.com/pgadmin4-db-create)はユーザ作成のページですが、わかりやすく記載されています。Windows 用のクライアントアプリ版のようなので、適宜読み替える必要があります。

<a id="deploy"></a>

# デプロイ

デプロイには `Fly.io` を使用します。
https://fly.io/

## アカウント作成

![image](https://user-images.githubusercontent.com/103744526/218354966-66b18861-0bed-43fb-8a3b-9a3874c28082.png)
会社のメールアドレスで OK
![image](https://user-images.githubusercontent.com/103744526/218354972-c5c78c83-6c99-4360-9877-0d02fe99fec6.png)
![image](https://user-images.githubusercontent.com/103744526/218354983-9b2ac9ef-14ff-4fd5-90bb-69fb69ed259b.png)

メールが送信されているので確認し、Verify Email のボタンを押す。

## flyctl のインストール

PowerShell で下記を実行

```ps
$ iwr https://fly.io/install.ps1 -useb | iex
```

## ログイン

PowerShell で下記を実行(コマンドがないと言われる場合は PowerShell を開き直す)

```ps
$ flyctl auth login
```

ブラウザが開くのでログインする
![image](https://user-images.githubusercontent.com/103744526/218354999-d1343f2b-ec3b-458f-858e-d8ffcf2ff36e.png)

## クレジットカードの登録

`Billing`をクリック
![image](https://user-images.githubusercontent.com/103744526/218355013-57c3796a-5656-4ae3-bf9d-9a130e69faf2.png)

`Add credit card`をクリック
![image](https://user-images.githubusercontent.com/103744526/218355019-ecdbcc54-1f96-4740-80ad-5fd52fd15d4d.png)

クレジットカード情報を入力
![image](https://user-images.githubusercontent.com/103744526/218355029-547d4cc0-c7fb-410d-b141-30df0705e292.png)

## Postgres の作成

```ps
$ flyctl postgres create
```

## Postgres のデプロイ

```ps
$ flyctl postgres create
```

> ? Choose an app name (leave blank to generate one):
>
> > technical-training-database-team-c

> ? Select region:
>
> > Tokyo, Japan (nrt)

> ? Select configuration:
>
> > Development - Single node, 1x shared CPU, 256MB RAM, 1GB disk

**接続情報が出力結果にあるため必ずコピーして保存する**

```
Postgres cluster technical-training-database-team-c created
  Username:    postgres
  Password:    MjtH1up0tuhGa91
  Hostname:    technical-training-database-team-c.internal
  Proxy port:  5432
  Postgres port:  5433
  Connection string: postgres://postgres:MjtH1up0tuhGa91@technical-training-database-team-c.internal:5432
```

## Laravel のデプロイ

```ps
$ cd backend
$ flyctl launch
```

> ? Would you like to copy its configuration to the new app?
>
> > y

> ? Overwrite "/Volumes/workspace/adglobe/2023-Technical-Training-Template/backend/.dockerignore"? (y/N)
>
> > n

> ? Overwrite "/Volumes/workspace/adglobe/2023-Technical-Training-Template/backend/.fly/entrypoint.sh"? (y/N)
>
> > n

> ? Overwrite "/Volumes/workspace/adglobe/2023-Technical-Training-Template/backend/.fly/scripts/caches.sh"? (y/N)
>
> > n

> ? Overwrite "/Volumes/workspace/adglobe/2023-Technical-Training-Template/backend/Dockerfile"? (y/N)
>
> > n

> ? Choose an app name (leave blank to generate one):
>
> > technical-training-backend-team-c

> ? Select region:
>
> > Tokyo, Japan (nrt)

> ? Would you like to deploy now? (y/N)
>
> > n

### 環境変数を設定する

**設定する値は`Postgresのデプロイ`手順で出力された値を使用する。**

```
$ flyctl secrets set \
  DB_HOST=technical-training-database-team-c.internal \
  DB_DATABASE=backend \
  DB_USERNAME=postgres \
  DB_PASSWORD=MjtH1up0tuhGa91 \
  DB_CONNECTION=pgsql
```

### Laravel と Postgres を接続する

```
$ flyctl postgres attach technical-training-database-team-c -a technical-training-backend-team-c
```

### backend/fly.toml を開き、PHP バージョンを 8.2 に変更する

```toml
PHP_VERSION = "8.0"
↓
PHP_VERSION = "8.2"
```

### デプロイする

```ps
$ flyctl deploy
```

### デプロイされているか確認する

```ps
$ flyctl open
```

### デプロイ後の環境に接続する

**※ 1 回目は失敗する事があるため、失敗した場合は何度か打ち直す**

```ps
$ flyctl ssh console
```

### migration を行う

```bash
# cd /var/www/html
# php artisan migrate
```

> Do you really wish to run this command? (yes/no) [no]
>
> > yes

```
 INFO  Preparing database.
Creating migration table ................................ 24ms DONE
 INFO  Running migrations.
2014_10_12_000000_create_users_table ... 18ms DONE
2014_10_12_100000_create_password_resets_table .......... 11ms DONE
2019_08_19_000000_create_failed_jobs_table .............. 12ms DONE
2019_12_14_000001_create_personal_access_tokens_table ... 19ms DONE
```

### 切断する

```
# exit
```

## Nuxt のデプロイ

```ps
$ cd ../frontend
$ flyctl launch
```

> ? Would you like to copy its configuration to the new app? (y/N)
>
> > y

> ? Choose an app name (leave blank to generate one):
>
> > technical-training-frontend

> ? Select region:
>
> > Tokyo, Japan (nrt)

> ? Would you like to set up a Postgresql database now? (y/N)
>
> > n

> ? Would you like to set up an Upstash Redis database now? (y/N)
>
> > n

> ? Would you like to deploy now? (y/N)
>
> > n

### 環境変数を設定する

```ps
$ flyctl secrets set PORT=3000
```

### .env.example をコピーして.env を作成する

### API_URL を修正する

API_URL=https://technical-training-backend-team-c.fly.dev

### デプロイする

```ps
$ flyctl deploy
```

### デプロイされているか確認する

```ps
$ flyctl open
```

## CI/CD - Github Actions

### fly.io の認証 token を取得する

```ps
$ flyctl auth token
```

token が表示されるので控えておく

> XaYgLGHPghNg8LfoETeSayol_2GLKgKJW9MpLxxxxxx

### Github に token を登録する

![image](https://user-images.githubusercontent.com/103744526/218355056-6f40c2b9-edcc-459a-a19c-30b82ec475a3.png)

![image](https://user-images.githubusercontent.com/103744526/218355070-08c1b4c5-69bc-4910-bf6c-3fb657f56c49.png)

### API のエンドポイントを登録する

登録する URL は `https://technical-training-backend-team-c.fly.dev`

![image](https://user-images.githubusercontent.com/103744526/218355100-c6708aa8-68a4-4f6c-8fbd-5e4340ec8f82.png)
