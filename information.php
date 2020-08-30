<?php
include 'mysql.php';
$no = $_GET['no'];

$row = $mysqli -> query("SELECT * FROM student WHERE no = '$no'") -> fetch_array(MYSQLI_ASSOC);

echo "Name: ".$row["name"]."<br>";
echo "Phone: ".$row["phone"]."<br>";
echo "Email: ".$row["email"]."<br>";
echo "Skills: ".str_replace("/", ", ", $row["skills"])."<br>";
echo "Majors: ".str_replace("/", ", ", $row["majors"])."<br>";
echo "Educations: ".str_replace("/", ", ", $row["educations"])."<br>";
echo "Experiences: ".str_replace("/", ", ", $row["experiences"])."<br>";
echo "Resume: <a href='python/hackathon/data/resume/$row[file]' target='_blank'>".$row["file"]."</a><br>";

exec("python/envs/hackathon/bin/python python/hackathon/src/document_similarity/predictor.py $row[file] 2>&1", $output);
$json = implode(PHP_EOL, $output);
print $json;
?>