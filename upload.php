<?php
include 'mysql.php';
$file = str_replace(' ','_',$_FILES['file']);
$name = $file["name"];
$type = $file["type"];
$size = $file["size"];
$tmp_name = $file["tmp_name"];
$extension = array_pop(explode('.', $name));


if($extension === "pdf" || $extension === "docx") {
  echo "<b>Upload successfully!</b><br>".$name."<br>".$type."<br>".$size."<br>".$tmp_name."<br>".$extension;
  move_uploaded_file($tmp_name, "python/hackathon/data/resume/$name");
  exec("python/envs/hackathon/bin/python python/hackathon/main.py $name", $output);
  $json = implode(PHP_EOL, $output);

  echo "<br><br><b>Get JSON from Python successfully!</b><br>";
  print $json;
  $student = json_decode($json);

  $name = preg_replace('/[^A-Za-z0-9\-\s]/', '', $student->name);
  $phone = preg_replace('/[^0-9]*/s', '', $student->phone);
  $email = preg_replace('/[^A-Za-z0-9\-\_\@\.]/', '', $student->email);
  $skills = preg_replace('/[^A-Za-z0-9\/\s]/', '', implode('/', $student->skills));
  $majors = preg_replace('/[^A-Za-z0-9\/]\s/', '', implode('/', $student->majors));
  $educations = preg_replace('/[^A-Za-z0-9\/\s]/', '', implode('/', $student->educations));
  $experiences = preg_replace('/[^A-Za-z0-9\/\s]/', '', implode('/', $student->experiences));
  echo "<br><br><b>Get student data successfully!</b><br>";
  echo $name."<br>".$phone."<br>".$email."<br>".$skills."<br>".$majors."<br>".$educations."<br>".$experiences."<br>".$file["name"];
} else {
  echo "File type error!";
}
//print $pdf
$sql = "INSERT INTO student (no, name, phone, email, skills, majors, educations, experiences, file) VALUES (NULL, '$name', '$phone', '$email', '$skills', '$majors', '$educations', '$experiences', '$file[name]')";

if ($mysqli->query($sql) === TRUE) {
  echo "<br><br><b>Insert DB successfully!</b><br>Done.";
} else {
  echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();

?>