<?php

namespace App\Message;

final class FontMinMessage
{
    private $fontFamily;
    private $text;
    private $newFontFamily;

    public function __construct(string $text, string $fontFamily, string $newFontFamily)
    {
        $this->fontFamily = $fontFamily;
        $this->text = $text;
        $this->newFontFamily = $newFontFamily;
    }

    /**
     * @return mixed
     */
    public function getFontFamily()
    {
        return $this->fontFamily;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getNewFontFamily()
    {
        return $this->newFontFamily;
    }

}
