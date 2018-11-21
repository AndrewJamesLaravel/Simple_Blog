<?php

$entryDataFound = isset( $entryData );
if ( $entryDataFound === false ) {
    trigger_error('views/entry-html.php needs an $entryData object');
}
return "<article>
            <h1>$entryData->title</h1>
            <div class='date'>$entryData->date_created</div>
            $entryData->entry_text
        </article>";