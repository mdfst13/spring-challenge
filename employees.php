<?php
  require 'includes/application.php';

  $statement = $db->prepare(<<<'EOSQL'
SELECT c.companies_name, e.employees_name
 FROM companies c INNER JOIN employees e ON c.companies_id = e.companies_id
 ORDER BY c.companies_id
EOSQL
    );
  $statement->execute();

  $employees = $statement->fetchAll();
  $statement = null;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Employees table</title>
    <style>
      TABLE {
        table-layout: fixed;
        width: 100%;
        border-collapse: collapse;
      }

      TH, TD {
        padding: 20px;
        border: 3px solid black;
      }

      TH {
        background-color: cornsilk;
      }
    </style>
  </head>
  <body>
    <h1>Employees table</h1>
    <table>
      <thead>
        <tr>
          <th>Company</th>
          <th>Employee</th>
        </tr>
      </thead>
      <tbody>
<?php
  foreach ($employees as $employee) {
    echo "        <tr>\n";
    printf("          <td>%s</td>\n", htmlspecialchars($employee['companies_name']));
    printf("          <td>%s</td>\n", htmlspecialchars($employee['employees_name']));
    echo "        </tr>\n";
  }
?>
      </tbody>
    </table>
  </body>
</html>
