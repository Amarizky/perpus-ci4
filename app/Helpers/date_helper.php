<?php

use CodeIgniter\I18n\Time;

function unixToHumanFull($unix = 0)
{
    return Time::createFromTimestamp($unix)->toLocalizedString('HH:mm d-MM-Y');
}

function unixToHumanDate($unix = 0)
{
    return Time::createFromTimestamp($unix)->toLocalizedString('d-MM-Y');
}
