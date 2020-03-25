<?php
// my_is_current_controller という関数が定義されているかどうか
if (! function_exists('my_is_current_controller')) {
    /**
     * 現在のコントローラ名が、複数の名前のどれかに一致するかどうかを判別する
     *
     * @param array $names コントローラ名 (可変長引数)
     * @return bool
     */
  // 定義されていない場合はmy_is_current_controllerを定義
  function my_is_current_controller(...$names) // 可変長引数…引数は、指定した変数$namesに配列として渡される
  {
    /**
     * Route::currentRouteName()…得られる結果は posts.index, posts.show など
     * explode()…第一引数'.'を区切りとし、配列として取り出す
     */
    $current = explode('.', Route::currentRouteName())[0]; //[0]でコントローラー名のみ取り出す
    // $currentが配列$namesにあればTRUEを返す
    return in_array($current, $names, true);
  }
}