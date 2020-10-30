<?
// $className = student\Student
require 'test.php';
require 'student.php';

use student\Student as stud;
use test\Student;

$student = new Student();
$student->sayHello();

$student = new stud();
$student->sayHello();


/* Чтобы не городить огромную портянку из if */
try {
	$a = 6;
	if ($a > 5) {
		throw new Exception('>5');
	}
} catch (Exception $e) {
	echo $e->getMessage();
}