<h2>自訂函式</h2>

<?php



echo name("Huang","HongJia");
echo "<br>";

$total = sum("告",15,2,4646,781,6814,6514,68,17,89,61,763817,83617,631,65,4514);

echo $total;

?>
</body>
</html>


<?php
function name($first, $last){
    echo $first . " " . $last;

}

//數字相加的函式
function add($num1, $num2){
    return $num1 + $num2;
}

//可以無限增加數字的函式?!
function sum($title, ...$nums){
    $tmp = 0;
    echo $title . "年終結算:";

    foreach($nums as $num){
        $tmp = $num + $tmp;
        echo $num. "+";
    }

    echo "=" . $tmp;
    echo "<br";
}


?>
