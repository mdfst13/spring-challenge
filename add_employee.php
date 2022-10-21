<?php
  require 'includes/application.php';

  if (!isset($_GET['company_id'])) {
    die('Company must be specified');
  }

  try {
    $statement = $db->prepare(<<<'EOSQL'
SELECT companies_id AS id, companies_name AS name FROM companies WHERE companies_id = ?
EOSQL
      );
    $statement->bindValue(1, (int)trim($_GET['company_id']));
    $statement->execute();

    if ($statement->rowCount() !== 1) {
      die('Invalid company');
    }

    $company = $statement->fetch();
  } catch (PDOException $e) {
    error_log('Error!: ' . $e->getMessage());
    die('Could not verify company');
  }

  if (isset($_POST['name'])) {
    try {
      $statement = $db->prepare(<<<'EOSQL'
INSERT INTO employees (employees_name, companies_id) VALUES (?, ?)
EOSQL
        );

      $statement->bindValue(1, trim($_POST['name']));
      $statement->bindValue(2, (int)$company['id']);

      if (!$statement->execute()) {
        error_log(implode(':', $statement->errorInfo()));
        die('Could not add employee to database');
      }
    } catch (PDOException $e) {
      error_log('Error!: ' . $e->getMessage());
      die('Could not add employee');
    }

    header('Location: companies.php');
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Add employee</title>
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
    <h1>Add employee to <?= htmlspecialchars($company['name']) ?></h1>
    <form action="add_employee.php?company_id=<?= (int)$company['id'] ?>" method="POST">
      <label>Name:  <input name="name" type="text" /></label>
      <input type="submit" value="Submit" />
    </form>
  </body>
</html>
