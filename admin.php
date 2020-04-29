<?php

namespace Admin;

use Core\Admin;
use Model\AdminModel;
use View\AdminView;
use Controller\AdminController;
use Model;


require_once( "app.php" );



$admin = new Admin( new AdminModel, new AdminView, new AdminController );
$admin->controller->sessionCheck();


$app->view->loadHeader();

$items = $admin->model->dbAsk();

// $statuses = $admin->model->getStatuses();


// $uniqueStatuses = array_unique( array_column( $statuses, "status" ) );
$uniqueStatuses = [ "complete",
                    "failed",
                    "in progress",
                    "new" ];

if( $_POST ) {
$logInCheck = $admin->controller->sessionCheck();

  if( $_POST['task'] == $_POST['task_check'] ) {
    $admin->model->updateStatus( $logInCheck );
  } else {
    $admin->model->updateAll( $logInCheck );
  }
}

?>
<body>
  <div class="container">
    <div class="jumbotron pt-3 pb-3">
      <div class="row justify-content-start justify-content-center justify-content-end">
        <div class="col-sm-9">
          <h4 class="display-10">Admin panel</h4>
        </div>
        <div class="col-sm-3">
          <a href="index.php" class="btn btn-light">On main</a>
          <a href="?auth=logout" class="btn btn-light">Logout</a>
        </div>
      </div>
    </div>
      <div class="row justify-content-start justify-content-center justify-content-end">

      <?php
      foreach( $items as $taskItem ):
      ?>
      <div class="col-sm-6">
        <div class="alert alert-light border border-dark" role="alert">

          <div class="clearfix">
            <div class="row">
              <div class="col-md-8">
                <span><b><?= $taskItem['user']; ?></b>
                  ( <?= $taskItem['email']; ?> )</span>
              </div>
              <div class="col-md-4">

                <form class="" action="admin.php" method="post">
                  <input type="submit" value="Apply" class="btn btn-primary ">
                  <input type="hidden" name="id" value="<?= $taskItem['id'] ?>">
              </div>
            </div>
          </div>

          <p>
            <div class="row">
              <div class="col-md-8">Edit task text:
                <textarea name="task" id="" cols="30" rows="3"><? if($_POST['task'] AND ($_POST['id'] ) == $taskItem['id']) {
                  echo $_POST['task'];} else {echo $taskItem['task'];
                } ?></textarea>
                <input type="hidden" name="task_check" value="<?=$taskItem['task']?>">
              </div>

             <div class="col-md-4">Change status:
               <select class="" name="status">
                 <?php
                 $selected = "selected";
                  foreach( $uniqueStatuses as $status ) {

                    if( $_POST['status'] AND ($_POST['id'] ) == $taskItem['id'] ) {
                      if( $status == $_POST[status] ){
                        echo "<option value='$status' $selected>$status</option>";
                      } else
                          echo "<option value='$status'>$status</option>";
                      }
                      // без POST
                      else {
                        if( $taskItem['status'] == $status )
                          echo "<option value='$status' $selected>$status</option>";
                        else
                          echo "<option value='$status'>$status</option>";
                      }

                  }
                  $_POST['ass'] = $taskItem['status'] ;
                 ?>
               </select>
             </form>
             </div>
           </div>
          </p>

        </div>
      </div>
      <? endforeach ?>

    </div>
  </div>
</body>
</html>
