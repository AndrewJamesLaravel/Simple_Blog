<?php

$searchDataFound = isset( $searchData );
if ( $searchDataFound === false ) {
    trigger_error('views/search-results-html.php needs $searchData');
}

$searchHTML = "<section id='search'>
    <p>You searched for <em>$searchTerm</em></p><ul>";
$searchMessage = "";
$rowCount = $searchData->rowCount();
if ( $rowCount === 0 ) {
    $searchMessage = "<li>No entries match your search</li>";
}
$searchHTML .= $searchMessage;
while ( $searchRow = $searchData->fetchObject() ) {
    $href = "index.php?page=blog&amp;id=$searchRow->entry_id";
    $searchHTML .= "<li><a href='$href'>$searchRow->title</a></li>";
}
$searchHTML .= "</ul></section>";
return $searchHTML;