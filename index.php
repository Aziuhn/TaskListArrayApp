<?php

require "lib/JSONReader.php";
require "lib/searchFunctions.php";


if(isset($_GET['text']) && $_GET['text']!==''){
    $text=$_GET['text'];
} else {
    $text='';
}

if(isset($_GET['status']) && $_GET['status']!==''){
    $status=$_GET['status'];
} else {
    $status='';
}

$taskList = JSONReader('dataset/Tasklist.json');

$filteredTaskList = array_filter($taskList,searchStatus($status));
$filteredTaskList = array_filter($filteredTaskList,searchText($text));

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Taklist</title>
</head>
<body>

    <form action="index.php">
        <div class="container-fluid bg-secondary py-3 mb-3 text-light">
            <div class="container">
                <h1 class="display-1">Tasklist</h1>
            </div>
        </div>
        <div class="container">
            <div class="input-group pb-3 my-1">
                <label class="w-100 pb-1 fw-bold" for="text">Cerca</label>
                <input id="text"  type="text" name="text" class="form-control" value="<?php echo($text) ?>">
                <div class="input-group-append">
                  <input type="submit" class="btn btn-primary" value="Invia">
                </div>
            </div>
            <div id="status-radio" class=" mb-3">
                <div class="fw-bold pe-2 w-100">Stato attività</div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="status" type="radio" value="all" <?php if($status === 'all'){echo('checked');}?>>
                    <label for="option0" class="form-check-label" >tutti</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="status" type="radio"   value="todo" <?php if($status === 'todo'){echo('checked');}?>>
                    <label for="option1" class="form-check-label" >da fare</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="status" type="radio"   value="progress" <?php if($status === 'progress'){echo('checked');}?>>
                    <label for="option2" class="form-check-label" >in lavorazione</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="status" type="radio"   value="done" <?php if($status === 'done'){echo('checked');}?>>
                    <label for="option3" class="form-check-label" >fatto</label>
                  </div>
            </div>
        
            <section class="tasklist mt-3">
                <h1 class="fw-bold fs-6">Elenco delle attività</h1>
                <table class="table">
                    <tr>
                        <th class="w-100">nome</th>
                        <th class="text-center">stato</th>
                        <th class="text-center">data</th>
                    </tr>
                    <?php
                    foreach($filteredTaskList as $task){
                        if($task['status']==='todo'){
                            echo("
                                <tr>
                                <td>$task[taskName]</td>
                                <td class='text-center'>
                                    <span class='badge bg-danger text-uppercase'>$task[status]</span>
                                </td>
                                <td class='text-nowrap'>
                                    $task[expirationDate]
                                </td>
                                </tr>
                            ");
                        } else {
                            if($task['status']==='done'){
                                echo("
                                <tr>
                                <td>$task[taskName]</td>
                                <td class='text-center'>
                                    <span class='badge bg-secondary text-uppercase'>$task[status]</span>
                                </td>
                                <td class='text-nowrap'>
                                    $task[expirationDate]
                                </td>
                                </tr>
                                ");
                            } else {
                                echo("
                                <tr>
                                <td>$task[taskName]</td>
                                <td class='text-center'>
                                    <span class='badge bg-primary text-uppercase'>$task[status]</span>
                                </td>
                                <td class='text-nowrap'>
                                    $task[expirationDate]
                                </td>
                                </tr>
                                ");
                            }
                        }
                    }
                    ?>
                </table>
            </section>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>