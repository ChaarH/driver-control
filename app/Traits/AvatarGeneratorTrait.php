<?php

namespace App\Traits;


trait AvatarGeneratorTrait
{
    public function generateLink($username): String
    {
        $textColor       = "";
        $backgroundColor = "";

        while ($textColor === $backgroundColor) {
            $textColor       = $this->randomColor();
            $backgroundColor = $this->randomColor();
        }

        $arrayParams = [
            'name'       => $username,
            'color'      => $textColor,
            'background' => $backgroundColor
        ];

        return "https://ui-avatars.com/api/?" . http_build_query($arrayParams);
    }

    private function randomColor(): String
    {
        return str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}