<?php
include 'mysql.php';
$keyword = $_POST['keyword'];


$keyword_array = explode("/", $keyword);

echo "<p>";

exec("python/envs/hackathon/bin/python python/hackathon/search_resume_with_keywords.py $keyword 2>&1", $output);
$json = implode(PHP_EOL, $output);
#$json = '{"relate": {"python": ["eclipse", "javascript", "coherence", "cache", "tortoise", "c++", "ide", "minitab", "cucumber", "node.js"], "java": ["eclipse", "angularjs", "python", "jcl", "javascript", "intellij", "js", "jquery", "tortoise", "css3"]}, "priority": [{"pdf": "Resume_Ronald_J.pdf", "total_score": 40.80699022184126, "related_vocabs": ["ide", "ms", "ant", "inventor", "urs", "ide", "issu", "nist", "ansi", "4.0"]}, {"pdf": "Elly_Yale_Resume.docx", "total_score": 37.814540673280135, "related_vocabs": ["ide", "ms", "eviews", "ant", "urs", "ide", "nist", "4.0", "xi", "cad"]}, {"pdf": "J-Charles+Clarkson.pdf", "total_score": 37.730540790827945, "related_vocabs": ["ide", "ms", "ant", "urs", "ide", "gen", "ood", "pi", "nis", "gy"]}, {"pdf": "Peter_Lin_Resume.pdf", "total_score": 37.627199940150604, "related_vocabs": ["ide", "ms", "eviews", "ant", "arm", "ide", "proc", "issu", "xi", "gen"]}, {"pdf": "NIta_Resume.pdf", "total_score": 37.585699297254905, "related_vocabs": ["ide", "ms", "road", "eviews", "ant", "urs", "ide", "hf", "hop", "pi"]}, {"pdf": "Resume_Johnson.pdf", "total_score": 37.316663700388744, "related_vocabs": ["ide", "ms", "ant", "urs", "ide", "nist", "4.0", "aml", "cad", "gen"]}, {"pdf": "Sierra_Tower_Resume.pdf", "total_score": 36.260832890169695, "related_vocabs": ["ide", "git", "ant", "urs", "ide", "proc", "hop", "ood", "lin", "nis"]}, {"pdf": "Marcell_Brown.pdf", "total_score": 33.68637154181488, "related_vocabs": ["ide", "ms", "ant", "urs", "ide", "proc", "issu", "cad", "pi", "lin"]}, {"pdf": "F-Wu.pdf", "total_score": 31.831156611209735, "related_vocabs": ["ide", "ms", "road", "ant", "ide", "issu", "nist", "cad", "gen", "pi"]}, {"pdf": "Eliza_Jones_Resume.pdf", "total_score": 31.041052452055737, "related_vocabs": ["ide", "road", "ant", "urs", "ide", "nist", "cad", "lin", "nis", "gy"]}, {"pdf": "Emily_Brown.pdf", "total_score": 30.672454602783546, "related_vocabs": ["ide", "ms", "ant", "ide", ".net", "gen", "ood", "pi", "exp", "al"]}, {"pdf": "RESUME_Seona_Bates.pdf", "total_score": 30.523508778540418, "related_vocabs": ["ide", "ms", "ant", "inventor", "urs", "ide", "issu", "cad", "pi", "lin"]}, {"pdf": "Saha_Cazenove_Resume.pdf", "total_score": 30.499865791993216, "related_vocabs": ["ide", "ant", "urs", "ide", "cad", "pi", "lin", "nis", "gy", "exp"]}, {"pdf": "Resume_Corey_Lucyshyn.pdf", "total_score": 29.320422587217763, "related_vocabs": ["ide", "ttl", "ant", "ide", "issu", "nist", "4.0", "gen", "ood", "lin"]}, {"pdf": "Giovanni_Bellini_Resume.pdf", "total_score": 29.09641881310381, "related_vocabs": ["ant", "urs", "cad", "gen", "ood", "lin", "mode", "al", "ood", "modeling"]}, {"pdf": "Resume_Sydney_Taylor.pdf", "total_score": 27.26458625611849, "related_vocabs": ["ide", "revit", "ide", "issu", "ood", "pi", "lin", "nis", "tree", "al"]}, {"pdf": "margot-perlman.pdf", "total_score": 27.052729197544977, "related_vocabs": ["ms", "ant", "perl", "urs", "proc", "nist", "pi", "lin", "nis", "mode"]}, {"pdf": "page-resume.pdf", "total_score": 26.805183882592246, "related_vocabs": ["ide", "urs", "ide", "proc", "issu", "xi", "etc", "hop", "pi", "gy"]}, {"pdf": "Resume_McAfee.pdf", "total_score": 26.714302392909303, "related_vocabs": ["ide", "ant", "urs", "ide", "cad", "hop", "ood", "lin", "nis", "al"]}, {"pdf": "Leo-Leopard_Resume.pdf", "total_score": 25.789858274860308, "related_vocabs": ["ide", "ms", "ant", "ide", "hop", "aim", "gen", "nis", "gy", "tree"]}, {"pdf": "Jack_August.docx", "total_score": 25.238348334794864, "related_vocabs": ["ide", "ttl", "ant", "ide", "proc", "issu", "pi", "lin", "gy", "tree"]}, {"pdf": "Emilia_Renzi.pdf", "total_score": 24.39027241128497, "related_vocabs": ["ide", "ms", "ant", "ide", "team-based", "ood", "pi", "lin", "nis", "gy"]}, {"pdf": "Sarah_Lake.docx", "total_score": 23.080466103507206, "related_vocabs": ["ide", "ms", "ant", "ide", "pi", "lin", "nis", "gy", "tree", "asp"]}, {"pdf": "Resume_Phoebe_Willoughby.pdf", "total_score": 22.81337311374955, "related_vocabs": ["ide", "ant", "urs", "ide", "4.5", "gen", "pi", "4.5", "al", "mi"]}, {"pdf": "Resume_Amanda_S.pdf", "total_score": 22.726186570944265, "related_vocabs": ["ide", "ms", "ide", "nist", "hop", "gen", "lin", "nis", "tree", "al"]}, {"pdf": ".DS_Store", "total_score": 0, "related_vocabs": []}]}';
$info = json_decode($json, true);

print "검색한 키워드: ".$keyword."<br><br>";

for($i =0; $i < sizeof($keyword_array); $i++){
    echo $keyword_array[$i]." 관련 키워드: ";
    $array = $info['relate'][$keyword_array[$i]];
    $j = 0;
    foreach ($array as $item) {
        if ($j > 0) {
            echo ", ".$item;
        } else {
            echo $item;
        }
        $j++;
    }
    echo "<br>";
}

echo "<br>추천 학생 목록<br><br>";

for($i = 0; $i < 5; $i++) {
    $file = $info['priority'][$i]['pdf'];
    $score = round($info['priority'][$i]['total_score'], 1);
    $related_vocabs = $info['priority'][$i]['related_vocabs'];
    #print $file;
    $row = $mysqli -> query("SELECT * FROM student WHERE file = '$file'") -> fetch_array(MYSQLI_ASSOC);
    echo ($i+1).". ".$row["name"]." <a href='information.php?no=$row[no]'>[보기]</a><br>Score: ".$score."%<br>이 학생에 대한 연관 키워드: ";
    for ($j=0;$j<10;$j++)
        if ($j > 0) {
            echo ", ".$related_vocabs[$j];
        } else {
            echo $related_vocabs[$j];
        }
        $j++;
    echo "<br><br>";
}







exit();
$temp = $info['priority'][0]['pdf'];
print $temp."<br>";
if ($result = $mysqli->query("SELECT * FROM student WHERE file = $temp")) {

    /* determine number of rows result set */
    $row_cnt = $result->num_rows;

    printf("Result set has %d rows.\n", $row_cnt);

    while( $student = $result->fetch_array() )
    {
        echo $student['name'] . " " . $student['email'];
        echo "<br />";
    }

    /* close result set */
    $result->close();
 } else {
    $row_cnt = $result->num_rows;

    printf("Result set has %d rows.\n", $row_cnt);
 }


// while( $student = $result->fetch_array() )
// {
//     echo $student['name'] . " " . $student['email'];
//     echo "<br />";
// }


// $keyword = $_POST['keyword'];


// $sql = "SELECT * FROM student WHERE skills LIKE '$keyword' OR majors LIKE '$keyword' OR educations LIKE '$keyword' OR experiences LIKE '$keyword'";

// $result = $mysqli->query($sql);



// while( $row = $result->fetch_array() )
// {
//     echo $row['name'] . " " . $row['email'];
//     echo "<br />";
// }


// $mysqli->close();

?>