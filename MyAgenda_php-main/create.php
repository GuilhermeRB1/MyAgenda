<?php
include_once("templates/header.php");
?>

<div class="container">
  <?php include_once("templates/backbtn.html"); ?>
  <h1 id="main-title">Create Contact</h1>
  <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
    <input type="hidden" name="type" value="create">
    <div class="form-group">
      <label for="name">Contact Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="type the name" required>
    </div>
    <div class="form-group">
      <label for="phone">Contact Phone</label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="type the phone" required>
    </div>
    <div class="form-group">
      <label for="observations">Contact Observation</label>
      <textarea type="text" class="form-control" id="observations" name="observations"
        placeholder="insert the observations" rows="3"></textarea>
    </div>
    <button id="btn-register" type="submit" class="btn btn-primary">Register</button>
  </form>
</div>


<?php
include_once("templates/footer.php");
?>