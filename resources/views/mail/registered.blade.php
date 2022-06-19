@component('mail::message')
# アカウント登録のお知らせ

{{ $user->name }}様

食事調査にご協力いただきましてありがとうございます。<br>
アカウントを作成致しましたので、お知らせいたします。

{{ $user->name }}様のアカウント情報<br>
メールアドレス：{{ $user->email }}<br>
パスワード：{{ $user->request_password }}

<!-- @component('mail::button', ['url' => ''])
ログインはこちらから
@endcomponent -->

<br>
@endcomponent
