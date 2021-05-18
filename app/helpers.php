

<?php

function getFormat($number)
{
    return number_format((float)$number, 2, '.', '');  // Outputs -> 105.00
}

function notFound()
{
    return url('images/notfound.gif');
}
