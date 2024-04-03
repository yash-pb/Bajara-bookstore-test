<?php
function sortArrowMatch($sortCol, $header, $cls)
{
    return $sortCol == $header ? $cls : '';
}