<?php
  require 'includes/application.php';

  if (isset($_POST['name'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip'])) {
    try {
      $statement = $db->prepare(<<<'EOSQL'
SELECT states_id FROM states WHERE states_code = ?
EOSQL
        );
      $statement->bindValue(1, strtoupper(trim($_POST['state'])));
      $statement->execute();

      if ($statement->rowCount() !== 1) {
        die('Invalid state');
      }
      $state_id = $statement->fetchColumn(0);
    } catch (PDOException $e) {
      error_log('Error!: ' . $e->getMessage());
      die('Could not verify state');
    }

    if (!preg_match('{^\d{5}(?:-\d{4})?$}', $_POST['zip'])) {
      error_log("Invalid zip:  [{$_POST['zip']}]");
      die('Invalid zip');
    }

    try {
      $statement = $db->prepare(<<<'EOSQL'
INSERT INTO companies (companies_name, companies_street, companies_extended, companies_city, states_id, companies_zip) VALUES (?, ?, ?, ?, ?, ?)
EOSQL
        );

      $statement->bindValue(1, trim($_POST['name']));
      $statement->bindValue(2, trim($_POST['street']));
      $statement->bindValue(3, trim($_POST['extended'] ?? ''));
      $statement->bindValue(4, trim($_POST['city']));
      $statement->bindValue(5, $state_id);
      $statement->bindValue(6, trim($_POST['zip']));

      if (!$statement->execute()) {
        error_log(implode(':', $statement->errorInfo()));
        die('Could not add company to database');
      }
    } catch (PDOException $e) {
      error_log('Error!: ' . $e->getMessage());
      die('Could not add company');
    }

    header('Location: companies.php');
    exit();
  }

  function build_state_options() {
    $statement = $GLOBALS['db']->prepare(<<<'EOSQL'
SELECT states_code, states_name FROM states
EOSQL
      );
    $statement->execute();

    $states = $statement->fetchAll();
    $statement = null;

    $result = '<option value="">Please select a state</option>' . "\n";

    foreach ($states as $state) {
      $result .= '<option value="' . $state['states_code'] . '">' . $state['states_name'] . "</state>\n";
    }

    return $result;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Add company</title>
    <style>
      LABEL {
        width: 100%;
      }

      INPUT[type=text], SELECT {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: block;
        border: 1px solid LightGray;
        border-radius: 4px;
        box-sizing: border-box;
      }

      INPUT[type=submit] {
        width: 100%;
        background-color: ForestGreen;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      INPUT[type=submit]:hover {
        background-color: Green;
      }
    </style>
  </head>
  <body>
    <h1>Add company</h1>
    <form action="add_company.php" method="POST">
      <label>Name:  <input name="name" type="text" /></label>
      <label>Street:  <input name="street" type="text" /></label>
      <label>Extended:  <input name="extended" type="text" /></label>
      <label>City:  <input name="city" type="text" /></label>
      <label>State:  <select name="state"><?= build_state_options() ?></select></label>
      <label>Zip:  <input name="zip" type="text" /></label>
      <input type="submit" value="Submit" />
    </form>
  </body>
</html>
