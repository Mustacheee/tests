<?php
// List employees that have a bigger salary than their boss
$answer1 = <<<SQL
  SELECT 
    Employees.Name
  FROM Employees
  INNER JOIN Employees as Boss ON Boss.EmployeeID = Employees.BossID
  WHERE Boss.EmployeeID <> Employees.EmployeeID
  AND Employees.Salary > Boss.Salary
  ;
SQL;

// List departments that have less than 3 people in it
$answer2 = <<<SQL
  SELECT 
    Departments.Name
  FROM Departments
  INNER JOIN Employees ON Employees.DepartmentID = Departments.DepartmentID
  GROUP BY Departments.DepartmentID
  HAVING COUNT(DISTINCT Employees.EmployeeID) < 3
  ;
SQL;

// List all departments along with the total salary there
$answer3 = <<<SQL
  SELECT 
    Departments.Name, 
    SUM(Employees.Salary) AS `Total Department Salary`
  FROM Departments
  INNER JOIN Employees ON Employees.DepartmentID = Departments.DepartmentID
  GROUP BY Departments.DepartmentID
  ;
SQL;

/**
 * List employees that don't have a boss in the same department
 * Opted for sub select to give y'all a break from joins. Also,
 * the subselect had a .1ms speed advantage
 */
$answer4 = <<<SQL
  SELECT 
    Employees.Name
  FROM Employees
  WHERE Employees.DepartmentID NOT IN (
	SELECT Boss.DepartmentID
	FROM Employees AS Boss
	WHERE Boss.EmployeeID = Employees.BossID
  )
  ;
SQL;

// List all departments along with the number of people there
$answer5 = <<<SQL
  SELECT 
    Departments.Name, 
    COUNT(DISTINCT Employees.EmployeeID) AS `Num. of Employees`
  FROM Departments
  INNER JOIN Employees ON Employees.DepartmentID = Departments.DepartmentID
  GROUP BY Departments.DepartmentID
  ;
SQL;


