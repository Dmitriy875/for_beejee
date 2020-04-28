<?php
use App\Paginator;
use Model\Model;
use Model\Queries;
use Model\PaginationModel;
use Model\TaskModel;
use View\View;
use View\TaskView;
use View\PaginationView;
use Controller\TaskController;



// Users for select
$dbSelectUsers = PaginationModel::getOrderBy( "SELECT user FROM task_book" );

$userNamesArr = array_column( $dbSelectUsers, 'user');
$userNamesUniqArr = array_unique( $userNamesArr );

// Emails for select
$dbSelectEmails = PaginationModel::getOrderBy( "SELECT email FROM task_book" );

$emailArr = array_column( $dbSelectEmails, 'email');
$emailUniqArr = array_unique( $emailArr );

// Statuses for select
$dbSelectStatus = PaginationModel::getOrderBy( "SELECT status FROM task_book" );

$statusArr = array_column( $dbSelectStatus, 'status');
$statusUniqArr = array_unique( $statusArr );

// FIXME: Replace all of that, what is higher


?>
<body>
<div class="container">
  <div class="jumbotron pt-4 pb-0">
    <div class="row">
      <div class="col-sm-3 offset-md-9">
      <?php

      if( $_SESSION['authenticated']): ?>
      <a href="admin.php" class="btn btn-light">Admin</a>
          <a href="?auth=logout" class="btn btn-light">Logout</a>
      <?php else: ?>
        <form action="/" method="POST">
          <div class="form-group">
            <!-- <label for="exampleInputEmail1">User</label> -->
            <input type="text" name="admin_name" placeholder="Login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <!-- <label for="exampleInputPassword1">Password</label> -->
            <input type="password" name="admin_password" placeholder="Password" class="form-control" id="exampleInputPassword1">
          </div>
          <button type="submit" name="auth_try" class="btn btn-primary" value='auth'>Sign in</button>
        </form>
        <? echo $deny ?>
      <?php endif ?>

      </div>
      <div class='col-sm-9'>
        <h1 class="display-3 text-white">Zen task-table</h1>
      </div>
    </div>
  </div>
</div>
<div class="row justify-content-start justify-content-center justify-content-end">
  <div class="col-md-6">
    <div class="alert alert-info" role="alert">

      <?php
      if( $_GET['name'] ) {
          $attr = "&name=".$_GET['name'];
      }
      if( $_GET['email'] ) {
          $attr = "&email=".$_GET['email'];
      }
      if( $_GET['status'] ) {
          $attr = "&status=".$_GET['status'];
      }
      if( $_GET['sort'] ) {
          $sort = "&sort=".$_GET['sort']."&type=".$_GET['type'];
      }
      ?>

      <table class="table">
        <thead>  <tr>
            <td><span class="alert-link">Sort by user: </span><span class="small"><a href="?sort=asc&type=user">asc</a> | <a href="?sort=desc&type=user">desc</a></span></td>
            <td><span class="alert-link">Sort by email: </span><span class="small"><a href="?sort=asc&type=email">asc</a> | <a href="?sort=desc&type=email">desc</a></span></td>
           <td><span class="alert-link">Sort by status: </span><span class="small"><a href="?sort=asc&type=status">asc</a> | <a href="?sort=desc&type=status">desc</a></span></td>
          </tr>
        </thead>
          <tr>
            <td><select class="" name="" onchange="if (this.value) window.location.href = this.value">
                <option value="">Select</option>
                <? foreach( $userNamesUniqArr as $userName ) {
                  echo "<option value='?name=$userName&select=name'>$userName</option>";
                }?>
              </select></td>
            <td><select class="" name="" onchange="if (this.value) window.location.href = this.value">
             <option value="">Select</option>
               <? foreach( $emailUniqArr as $userEmail ) {
                 echo "<option value='?email=$userEmail&select=email'>$userEmail</option>";
               }?>
                </select>
         </td>
         <td><select class="" name="" onchange="if (this.value) window.location.href = this.value">
           <option value="">Select</option>
           <? foreach( $statusUniqArr as $status ) {
             echo "<option value='?status=$status&select=status'>$status</option>";
           }?>
         </select></td>
          </tr>
      </table>
    </div>

      <?php

      foreach( $dbResult as $person ): ?>

      <div class="alert alert-secondary" role="alert">

        <div class="clearfix">
          For user: <a href="?name=<?= $person['user']; ?>" class="alert-link">
          <?= $person['user']; ?></a>

          ( <a href="?email=<?= $person['email']; ?>" class="small"><?= $person['email']; ?></a> )
        </div>

        <div class="row">
          <div class="col-sm-9">
            Task: <span class="alert-link"><?= $person['task']; ?></span>
          </div>

          <div class="col-sm-3 text-right"><?php if( $person['admin_edit'] ) echo "<small>Edited by admin</small>"; ?></div>
        </div>

        <div class="clearfix">
          <a href="?status=<?= $person['status']; ?>" class="alert-<?= $paginator->view->statusColor( $person['status'] ) ?>"> <?= $person['status']; ?></a>
        </div>
      </div>
    <?php endforeach ?>
      </tbody>
    </table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">

        <li class="page-item">
          <a class="page-link" href="?current_page=<?= $paginator->controller->navPrevious() . $attr.$sort ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

      <?php
      echo $numOfItems;
      // echo $paginator->controller->getNumOfAllPages();
        for( $i = 1; $i < ( $paginator->controller->getNumOfAllPages( $numOfAllItems ) +1 ); $i++) {
          echo '<li class="page-item"><a class="page-link" href="?current_page='.$i.$attr.$sort.'">' . $i . '</a></li>';
        }
        ?>

        <li class="page-item">
          <a class="page-link" href="?current_page=<?= $paginator->controller->navNext() . $attr.$sort ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
        <?php
        if( $_GET )
          echo '<span><a href="/" class="page-link">reset</a></span>';
        ?>

      </ul>
    </nav>
    <?php
    echo $taskCreator->view->formValidation();
    $taskCreator->view->getForm();
    if( $taskCreator->view->queryPermission == true ) {
      $taskCreator->model->createTask( $_POST );
    }
    ?>
  </div>
</div>
</body>
</html>
