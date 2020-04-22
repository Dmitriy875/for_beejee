<?
use Model\Queries;

if( $_GET['name'] ) {
  $dbResult = Queries::getOrderBy( "SELECT * FROM task_book WHERE user = '$_GET[name]'");
} elseif ( $_GET['email'] ) {
  $dbResult = Queries::getOrderBy( "SELECT * FROM task_book WHERE email = '$_GET[email]'");
} elseif ( $_GET['status'] ) {
  $dbResult = Queries::getOrderBy( "SELECT * FROM task_book WHERE status = '$_GET[status]'");
} else {
    $dbResult = Queries::getOrderBy( "SELECT * FROM task_book" );
  }



?>
<body>
<div class="container">
  <div class="jumbotron">
    <h1 class="display-3">Zen task-table</h1>
    <hr class="m-y-md">
    </p>

  </div>
</div>
<div class="row justify-content-start justify-content-center justify-content-end">
  <div class="col-md-6">
    <div class="alert alert-info" role="alert">
      <a href="?sort=user" class="alert-link">Sort by: User</a> | :: | <a href="?sort=email" class="alert-link">Sort by: Email</a> | :: | <a href="?sort=status" class="alert-link">Sort by: Status</a>
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



      <!-- <table class="table">
        <thead>
          <tr>
            <th scope="col"><a href="?sort=status" class="alert-light">Status</a></th>
            <th scope="col"><a href="?sort=name" class="alert-light">User name:</a></th>
            <th scope="col"><a href="?sort=email" class="alert-light">Email:</a></th>
            <th scope="col"><span class="alert-light">To do:</span></th>
          </tr>
        </thead>
        <tbody>
      <?// foreach( $dbResult as $person ): ?>
      <tr>
        <td><? $person['status']; ?></td>
        <td><? $person['user']; ?></td>
        <td><? $person['email']; ?></td>
        <td><? $person['task']; ?></td>
      </tr>
      <? //endforeach ?> -->


      </tbody>
    </table>
  </div>
</div>
</body>
</html>
