{{-- ユーザー登録確認用のメール --}}
<h3>
  <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
</h3>
<p>
    下記のリンクをクリックして、このメールアドレスでユーザー登録することを確認してください。<br>
    このメールに心当たりがない場合は、このまま削除して下さい。
</p>
<p>
    <a href="{{ $actionUrl }}">{{ $actionText }}</a>
</p>