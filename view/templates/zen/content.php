<?
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
    </p>

  </div>
</div>
<div class="row justify-content-start justify-content-center justify-content-end">
  <div class="col-md-6">
    <div class="alert alert-info" role="alert">
      Sort by: User
        <select class="" name="" onchange="if (this.value) window.location.href = this.value">
          <option value="">Select</option>
          <? foreach( $userNamesUniqArr as $userName ) {
            echo "<option value='?name=$userName'><a href='?poo=1'>$userName</a></option>";
          }?>
        </select>
       | :: | <span class="alert-link">Sort by:
         <select class="" name="" onchange="if (this.value) window.location.href = this.value">
           <option value="">Select</option>

         <? foreach( $emailUniqArr as $userEmail ) {
           echo "<option value='?email=$userEmail'>$userEmail</option>";
         }?>
       </select></span> | :: | <span class="alert-link">Sort by:
         <select class="" name="" onchange="if (this.value) window.location.href = this.value">
           <option value="">Select</option>
           <? foreach( $statusUniqArr as $status ) {
             echo "<option value='?status=$status'><a href='?poo=1'>$status</a></option>";
           }?>
         </select>
       </span>
    </div>

      <? foreach( $dbResult as $person ): ?>
      <div class="alert alert-secondary" role="alert">

        For user:

        <a href="?name=<?= $person['user']; ?>" class="alert-link">
          <?= $person['user']; ?>
        </a>

        (< <a href="?email=<?= $person['email']; ?>"><?= $person['email']; ?></a> >)

        <span class="alert-link"> :: <?= $person['task']; ?></span> |

        <a href="?status=<?= $person['status']; ?>" class="alert-primary"> <?= $person['status']; ?></a>
      </div>
      <? endforeach ?>
      </tbody>
    </table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">

        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

        <?
        for( $i = 1; $i < ( $paginator->getNumOfAllPages() +1 ); $i++) {
          echo '<li class="page-item"><a class="page-link" href="?current_page='.$i.'">' . $i . '</a></li>';
        }
        ?>

        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</div>
</body>
</html>
