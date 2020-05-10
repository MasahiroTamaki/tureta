<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class DatePicker extends BaseComponent
{
    /**
     * コンポーネントのルートセレクタ取得
     *
     * @return string
     */
    public function selector()
    {
        return '.date-picker';
    }

    /**
     * ブラウザページにそのコンポーネントが含まれていることをアサート
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertVisible($this->selector());
    }

    /**
     * コンポーネントの要素のショートカットを取得
     *
     * @return array
     */
    public function elements()
    {
        return [
          '@date-field' => 'input.datepicker-input',
          '@month-list' => 'div > div.datepicker-months',
          '@day-list' => 'div > div.datepicker-days',
        ];
    }

     /**
     * 指定日付のセレクト
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  int  $month
     * @param  int  $day
     * @return void
     */
    public function selectDate($browser, $month, $day)
    {
        $browser->click('@date-field')
                ->within('@month-list', function ($browser) use ($month) {
                    $browser->click($month);
                })
                ->within('@day-list', function ($browser) use ($day) {
                    $browser->click($day);
                });
    }
}
