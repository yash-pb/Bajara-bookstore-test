<?php
use App\Models\Book;


function sortArrowMatch($sortCol, $header, $cls)
{
    return $sortCol == $header ? $cls : '';
}

function getBookName($id)
{
    return (Book::select('name')->find($id))->name ?? '';
}