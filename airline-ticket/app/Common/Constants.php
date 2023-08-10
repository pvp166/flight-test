<?php

namespace App\Common;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;

class Constants
{
    //
    const DEFAULT_SORTING = 1;
    const DEFAULT_PAGE = 1;
    const DEFAULT_ITEM_PER_PAGE = 20;
    const DEFAULT_EMPTY_NUMBER = 0;
    const DEFAULT_STOCK_NUMBER = 1;
    const DEFAULT_EMPTY_STRING = "";
    const DEFAULT_EMPTY_ARRAY = [];

    const STR_PAD_4_SPACE = '    ';
    const STR_PAD_5_SPACE = '     ';
    const STR_PAD_6_SPACE = '      ';
    const STR_PAD_9_SPACE = '         ';
    const STR_PAD_10_SPACE = '          ';
    const STR_PAD_15_SPACE = '               ';

    const STR_PAD_2_ZERO = '00';
    const STR_PAD_3_ZERO = '000';
    const STR_PAD_4_ZERO = '0000';
    const STR_PAD_5_ZERO = '00000';

    const YES = 1;
    const NO = 0;

    const ON = 1;
    const OFF = 0;

    // Config JWT Expire time (second*minute*hour*day)
    const JWT_EXPIRE = 60 * 60 * 24 * 30;

    /**
     * Get info by packageNo
     *
     * @param $pkgNo
     * @param $pkgAmount
     * @param $pkgToken
     */
    public static function getInfoByPackage($pkgNo, &$pkgAmount, &$pkgToken)
    {
        $psPkg = collect(config('baoe.ps_packages'))->firstWhere('package_no', $pkgNo);
        $pkgAmount = $psPkg['amount'];
        $pkgToken = $psPkg['token'];
    }



    public static function vn_to_str($str)
    {
        if ($str == null || strlen($str) < 1) {
            return 0;
        }

        if (!$str)
            return false;
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|á|ấ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ',
            'D' => 'Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ồ|ò',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '-' => ' |/|'
        );

        foreach ($unicode as $khongdau => $codau) {
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $str);
        }

        foreach ($unicode as $khongdau => $codau) {
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $str);
        }

        $str = str_replace(' ', '-', $str); // Replaces all spaces with hyphens.
        $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str); // Removes special chars.



        return $str;
    }

}