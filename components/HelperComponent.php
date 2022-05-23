<?php

namespace app\components;

use Yii;


class HelperComponent extends \yii\base\Component
{
    public static function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return $hasil;
    }

    public static function myArrayHelper($arr, $index)
    {
        $returnArr = [];
        foreach ($arr as $key => $value) {
            $returnArr[$key] = $value[$index];
        }
        return $returnArr;
    }

    /**
     * Get berkas filename
     * 
     * @return string
     */
    public static function getImageFilename($file_url, $path)
    {
        $ms_cabang_id = Yii::$app->user->identity->ms_cabang_id;
        $filename = str_replace('files/images/' . $path . '/' . $ms_cabang_id . '_', '', $file_url);
        $filename = substr($filename, 15);

        return $filename;
    }

    /**
     * Resize Uploaded Image
     * 
     * @return boolean
     */
    /*
    public static function resizeImage($file, $save_path, $new_width = 1024, $new_height = 768, $quality = 80)
    {
        $options = array(
            'resolution-units' => 'ppi',
            'resolution-x' => $new_width,
            'resolution-y' => $new_height,
            'jpeg_quality' => $quality,
        );

        $imagine = \yii\imagine\Image::getImagine()
            ->open($file->tempName)
            ->thumbnail(new \Imagine\Image\Box($new_width, $new_height))
            ->save($save_path, $options);

        return $imagine;
    }*/

    public static function dateConverter($date, $display = false) {
        if ($display) return date('d M Y', strtotime($date));
        else return date('Y-m-d H:i:s', strtotime($date));
    }

    public static function timeConverter($date, $display = false) {
        if ($display) return date('H:i', strtotime($date));
        else return date('Y-m-d H:i:s', strtotime($date));
    }

    public static function dateTimeConverter($date, $display = false) {
        if ($display) return date('d M Y H:i', strtotime($date));
        else return date('Y-m-d H:i:s', strtotime($date));
    }

    public static function dateTimeConverter2($date, $display = false) {
        if ($display) return date('H:i / d M Y', strtotime($date));
        else return date('Y-m-d H:i:s', strtotime($date));
    }
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}
