<?php

use Model\Queries;
use View\View;
use View\PaginationView;
use Model\Model;
use Model\PaginationModel;
use Controller\PaginationController;



$paginator = new PaginationController(  new PaginationView,
                                        new PaginationModel );

$paginator->getCurrentPage();
$paginator->getNumOfItemsToShow();
$paginator->getNumOfAllPages();

// NOTE: Set GET-param as settings of number of items at one page
$dbResult = $paginator->model->selectByGetParam(  $paginator->paginatorCurrentPage(),
                                                  $paginator->getNumOfItemsToShow() );


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
  <div class="jumbotron pt-4 bg-img">
    <div class="row">
      <div class="col-sm-2 offset-md-10">
        <form class="" action="#" method="post" style="float:left">
          <button id='sign' type="button" class="btn btn-light">Sign in</button>
        </form>
        <!-- <input type="submit" class="btn btn-light" name="" value="Sign in"> -->
      </div>
      <div class='col-sm-9'>
        <h1 class="display-3 text-white">Zen task-table</h1>
        <hr class="m-y-md">
      </div>
      <div id='signinhide'class="col-sm-3" style="display: none">

      </div>
    </div>

  </div>
</div>
<div class="row justify-content-start justify-content-center justify-content-end">
  <div class="col-md-6">
    <div class="alert alert-info" role="alert">
      <span class="alert-link">Sort by: User
        <select class="" name="" onchange="if (this.value) window.location.href = this.value">
          <option value="">Select</option>
          <? foreach( $userNamesUniqArr as $userName ) {
            echo "<option value='?name=$userName&select=name'>$userName</option>";
          }?>
        </select></span> | :: |

       <span class="alert-link">Sort by:
         <select class="" name="" onchange="if (this.value) window.location.href = this.value">
           <option value="">Select</option>

         <? foreach( $emailUniqArr as $userEmail ) {
           echo "<option value='?email=$userEmail&select=email'>$userEmail</option>";
         }?>
       </select></span> | :: |

       <span class="alert-link">Sort by:
         <select class="" name="" onchange="if (this.value) window.location.href = this.value">
           <option value="">Select</option>
           <? foreach( $statusUniqArr as $status ) {
             echo "<option value='?status=$status&select=status'>$status</option>";
           }?>
         </select>
       </span>
    </div>

      <?php foreach( $dbResult as $person ): ?>

      <div class="alert alert-secondary" role="alert">

        <div class="clearfix">
          For user: <a href="?name=<?= $person['user']; ?>" class="alert-link">
          <?= $person['user']; ?></a>

          ( <a href="?email=<?= $person['email']; ?>" class="small"><?= $person['email']; ?></a> )
        </div>

        Task: <span class="alert-link"><?= $person['task']; ?></span>

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
          <a class="page-link" href="?current_page=<?= $paginator->navPrevious() ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

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
        for( $i = 1; $i < ( $paginator->getNumOfAllPages() +1 ); $i++) {
          echo '<li class="page-item"><a class="page-link" href="?current_page='.$i.$attr.'">' . $i . '</a></li>';
        }
        ?>

        <li class="page-item">
          <a class="page-link" href="?current_page=<?= $paginator->navNext() ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
        <?php
        if( $_GET )
          echo '<span><a href="/" class="page-link">reset</a></span>';
        ?>

      </ul>
    </nav>
  </div>
</div>
</body>
</html>
