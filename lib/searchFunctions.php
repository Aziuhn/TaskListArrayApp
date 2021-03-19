<?php
/**
 * Funzione di ordine superiore funzione che restituisce una funzione
 * Programmazione Funzionale - dichiarativo 
 */
function searchText($searchText) {
    return function ($task) use ($searchText){
        $task['taskName'] = trim(strtolower($task['taskName']));
        $searchText = trim(strtolower($searchText));

        if($searchText === ''){
            return true;
        } else {
            return strpos($task['taskName'],$searchText)!==FALSE;
        }
    };  
}

/**
 * @var string $status è la stringa che corrisponde allo status da cercare
 * (progress|done|todo)
 * @return callable La funzione che verrà utilizzata da array_filter
 */
function searchStatus($status){
    return function ($task) use ($status) {
        if(($status === '') || ($status === 'all')){
            return true;
        } else {
            if($task['status'] === $status){
                return true;
            } else {
                return false;
            }
        }
    };
} 
