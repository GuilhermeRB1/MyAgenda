<?php
include_once("templates/header.php");
?>

<div class="container">
  <?php include_once("templates/backbtn.html"); ?>
  <h1 id="main-title">Edit Contact</h1>
  <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
    <input type="hidden" name="type" value="edit">
    <input type="hidden" name="id" value="<?= $contacts['id'] ?>">
    <div class="form-group">
      <label for="name">Contact Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="type the name" value="<?= $contacts['name'] ?>" required>
    </div>
    <div class="form-group">
      <label for="phone">Contact Phone</label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="type the phone" value="<?= $contacts['phone'] ?>" required>
    </div>
    <div class="form-group">
      <label for="observations">Contact Observation</label>
      <textarea type="text" class="form-control" id="observations" name="observations"
        placeholder="insert the observations" rows="3"><?= $contacts['observations'] ?></textarea>
    </div>
    <button id="btn-register" type="submit" class="btn btn-primary">Update</button>
  </form>
</div>


<?php
include_once("templates/footer.php");
?>