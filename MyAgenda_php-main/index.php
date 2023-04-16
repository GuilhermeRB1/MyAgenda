<?php
include_once("templates/header.php");
?>

<div class="container">
  <?php if (isset($printMsg) && $printMsg != ''): ?>
  <p id="msg">
    <?= $printMsg ?>
  </p>
  <?php endif; ?>
  <h1 id="main-title">My Agenda</h1>
  <?php if (count($contacts) > 0): ?>
  <table class="table" id="contacts-table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Phone</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($contacts as $contact): ?>
      <tr>
        <td scope="row">
          <?= $contact["id"] ?>
        </td>
        <td scope="row">
          <?= $contact["name"] ?>
        </td>
        <td scope="row">
          <?= $contact["phone"] ?>
        </td>
        <td class="actions">
          <a href="<?= $BASE_URL ?>show.php?id=<?= $contact["id"] ?>"><i class="fas fa-eye check-icon"></i></a>
          <a href="<?= $BASE_URL ?>edit.php?id=<?= $contact["id"] ?>"><i class="far fa-edit edit-icon"></i></a>
          <form class="delete-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
            <input type="hidden" name="type" value="delete">
            <input type="hidden" name="id" value="<?= $contact["id"] ?>">
            <button class="erase-btn" type="submit"><i class="fas fa-eraser eraser-icon "></i></i></button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else: ?>
  <p id="empty-list-text">You don't have a contact in your agenda yet, <a href="<?= $BASE_URL ?>create.php">Click here
      to add</a>.</p>
  <?php endif; ?>
</div>

<?php
include_once("templates/footer.php");
?>