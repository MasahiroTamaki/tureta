<h3>
    <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
</h3>
<p>
    下記URLをクリックして、パスワードを再設定してください。<br>
    このメールに心当たりがない場合は、このまま削除して下さい。
</p>
<p>
    {{ $actionText }}: <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
</p>