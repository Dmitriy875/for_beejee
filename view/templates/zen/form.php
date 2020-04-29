<hr>
<h4>Create new task</h4>
<div class="col-md-6 pl-0">
  <form action="/" method="POST">
    <fieldset class="form-group">
      <label for="formGroupExampleInput">User name</label>
      <input type="text" name="name" class="form-control" id="user_name" placeholder="Or nickname, who cares">
    </fieldset>
    <fieldset class="form-group">
      <label for="formGroupExampleInput">User email</label>
      <input type="text" name="email" class="form-control" id="user_email" placeholder="Email">
    </fieldset>
    <fieldset class="form-group">
      <label for="formGroupExampleInput2">To do</label>
      <textarea name="task" class="form-control" id="task_text" placeholder="Task text"></textarea>
    </fieldset>
    <input type="submit" name="create_try" value="Create">
  </form>
</div>
