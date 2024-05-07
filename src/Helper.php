<?php

namespace src;

class Helper
{
    /**
     * ensures the input is displayed as text and not as e.g. a html-tag
     * @param ...$params
     * @return array
     */
    public static function validate(...$params): array
    {
        foreach ($params as &$param) {
            $param = htmlspecialchars($param);
        }
        return $params;

    }
}