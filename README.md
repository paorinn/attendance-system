<h1>Atte(勤怠管理アプリ)</h1>
<h2>環境構築</h2>
<h3>Dockerビルド</h3>
<ol>
<li><pre>git clone git@github.com:estra-inc/confirmation-test-contact-form.git</pre>
<li>DockerDesktopアプリを立ち上げる
<li><pre>docker-compose up -d --build</pre></li>
</ol>

<h3>Laravel環境構築</h3>

<ol>
<li><pre>docker-compose exec php bash</pre>
<li><pre>composer install</pre>
<li>「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
<li>.envに以下の環境変数を追加
<pre>
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
</pre>
<li>アプリケーションキーの作成
<pre>php artisan key:generate</pre>
<li>マイグレーションの実行
<pre>php artisan migrate</pre>
<li>シーディングの実行
<pre>php artisan db:seed</pre>
</ol>

<h2>使用技術（実行環境）</h2>
<dl>
  <li>PHP8.3.4
  <li>laravel8.83.8
  <li>MySQL8.0.26
</dl>
<h2>ER図</h2>
<img width="525" alt="スクリーンショット 2024-08-06 1 06 02" src="https://github.com/user-attachments/assets/6d3cd3d1-f0fe-442c-a85b-d1e032e34981">


<h2>URL</h2>
<dl>
<li>開発環境：http://localhost/
<li>phpMyAdmin:：http://localhost:8080/
</dl>
<h2>備考</h2>
休憩ボタンを押したら日付一覧が表示されなくなるため、無効にしてます。
