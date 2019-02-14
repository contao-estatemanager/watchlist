<?php

// Add fields
array_insert($GLOBALS['TL_DCA']['tl_member']['fields'], 1, array
(
    'watchlist' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_module']['watchlist'],
        'sql'                     => "blob NULL"
    )
));