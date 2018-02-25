<?php
/**
 * Created by PhpStorm.
 * User: hanspistor
 * Date: 2/25/18
 * Time: 1:57 PM
 */


function game() {
    if (!isset($_SESSION["board"])) {
        $_SESSION["board"] = array(
                "button1" => "1",
                "button2" => "2",
                "button3" => "3",
                "button4" => "4",
                "button5" => "5",
                "button6" => "6",
                "button7" => "7",
                "button8" => "8",
                "button9" => "&nbsp;"
        );
    }

    display_board();
}


function display_board() {
    foreach($_SESSION['board'] as $name => $val) {
        if (isset($_POST[$name]))  {
            setcookie("button", $name, time()+3600, "/", "", 0);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
    }
    if (isset($_COOKIE['button'])) {
        move_item($_COOKIE['button']);
    }
    echo "<div id=\"puzzle\" class=\"container\">";
    echo "<form id=\"button\" action='' method='post'>";
    $count = 0;
    foreach($_SESSION["board"] as $name => $val) {
        if ($count % 3 == 0) {
            echo "<div class=\"row justify-content-md-center justify-content-sm-center\">";
        }
        echo "<button type=\"submit\" name='" . $name . "' class=\"btn btn-secondary custombutton\">" . $val . "</button>";
        if ($count % 3 == 2) {
            echo "</div>";
        }
        $count += 1;
    }
    echo "</form>";
    echo "</div>";
}

function getEmpty() {
    foreach($_SESSION["board"] as $name => $val) {
        if ($val == "&nbsp;") {
            return $name;
        }
     }
}


function isMoveable($tile) {
    $toNumber = array();
    $btnNum = $tile[6];
    if(in_array($btnNum, array("3", "6", "9"))) {
        $toNumber = array(3, -3, -1);
    }
    if (in_array($btnNum, array("1", "4", "7"))) {
        $toNumber = array(3, -3, 1);
    }
    if (in_array($btnNum, array("2", "5", "8"))) {
        $toNumber = array(3, -3, 1, -1);
    }
    $val = (int)$btnNum;
    foreach($toNumber as $num) {
        if ($val + $num == getEmpty()[6]) {
            return true;
        }
    }
    return false;

}

function pushTile($tile) {

}

function move_item($item) {
    if (isMoveable($item)) {
        echo "Moveable";
    } else {
        echo "Not Moveable";
    }
}