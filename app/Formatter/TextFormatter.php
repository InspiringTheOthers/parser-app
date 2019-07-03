<?php

namespace App\Formatter;

use App\Exception\ParserException;

final class TextFormatter
{
    public const GREEN_COLOR = 'green';
    public const LIGHT_GREEN_COLOR = 'light_green';
    public const BLACK_COLOR = 'black';
    public const DARK_GRAY_COLOR = 'dark_gray';
    public const BLUE_COLOR = 'blue';
    public const LIGHT_BLUE_COLOR = 'light_blue';
    public const RED_COLOR = 'red';
    public const PURPLE_COLOR = 'purple';
    public const YELLOW_COLOR = 'yellow';
    public const WHITE_COLOR = 'white';

    /**
     * @var array
     */
    private $colors = [
        'green' => '0;32',
        'light_green' => '1;32',
        'black' => '0;30',
        'dark_gray' => '1;30',
        'blue' => '0;34',
        'light_blue' => '1;34',
        'red' => '0;31',
        'purple' => '0;35',
        'yellow' => '1;33',
        'white' => '1;37'
    ];

    /**
     * @var string
     */
    private $colorLayout = "\033[{color}m";

    /**
     * @param string $text
     * @param string $color
     * @return string
     * @throws ParserException
     */
    public function color(string $text, string $color): string
    {
        if (!array_key_exists($color, $this->colors)) {
            throw new ParserException('There is no such color!');
        }

        $colorSettings = str_replace('{color}', $this->colors[$color], $this->colorLayout);

        return $colorSettings . $text;
    }
}