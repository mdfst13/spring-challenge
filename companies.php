<?php
  require 'includes/application.php';

  $statement = $db->prepare(<<<'EOSQL'
SELECT c.companies_id AS `id`, c.companies_name AS name, COUNT(e.employees_id) AS employee_count
 FROM companies c LEFT JOIN employees e ON c.companies_id = e.companies_id
 GROUP BY c.companies_id
 ORDER BY c.companies_id
EOSQL
    );
  $statement->execute();

  $companies = $statement->fetchAll();
  $statement = null;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Companies table</title>
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
    <table>
      <thead>
        <tr>
          <th>Company</th>
          <th>Number of employees</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
<?php
  foreach ($companies as $company) {
    echo "        <tr>\n";
    printf("          <th>%s</th>\n", htmlspecialchars($company['name']));
    echo "          <td>{$company['employee_count']}</td>\n";
    echo '          <td><a href="add_employee.php?company_id=' . $company['id'] . '">Add employee</a></td>' . "\n";
    echo "        </tr>\n";
  }
?>
      </tbody>
    </table>
    <p><a href="add_company.php">Add company</a></p>
  </body>
</html>
