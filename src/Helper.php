<?php

namespace src;

class Helper
{
    /**
     * ensures the input is displayed as text and not as e.g. a html-tag
     * @param ...$params
     * @return array
     */
    public static function html_validate(...$params): array
    {
        foreach ($params as &$param) {
            $param = htmlspecialchars($param);
        }
        unset($param);
        return $params;

    }
}