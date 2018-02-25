<?php
/**
 * Created by PhpStorm.
 * User: hanspistor
 * Date: 2/25/18
 * Time: 1:57 PM
 */


function game() {
    if (!isset($_SESSION["board"])) {
        $_SESSION['firstplay'] = true;
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
    } else {
        $_SESSION['firstplay'] = false;
    }
    if (isset($_POST["clearsession"]))  {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }

    if (isset($_POST["randomize"])) {
        randomize();
    }



    display_board();
    display_buttons();
}

function display_buttons() {
    echo "<div id=\"puzzle\" class=\"container\">";

    echo "<div class=\"row justify-content-md-center justify-content-sm-center\">";

    echo "<form id=\"clearsession\" action='' method='post'>";
    echo "<button name=\"clearsession\" class=\"btn btn-primary btn-lg\">Clear Session</button>";
    echo "</form>";


    echo "<form id=\"randomize\" action='' method='post'>";
    echo "<button name=\"randomize\" class=\"btn btn-danger btn-lg\">Randomize</button>";
    echo "</form>";

    echo "</div>";

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

    $solved = $_SESSION['solved'] && !$_SESSION['firstplay'] ? "<h1 id=\"solved\" style=\"color: green\">Solved!</h1>" : "";
    echo $solved;
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

function checkState() {
    foreach($_SESSION["board"] as $name => $val) {
        if (!($name === "button9")) {
            $check = (int)$name[6];
            if ($check != $val) {
                return false;
            }
        }
    }
    return true;
}

function pushTile($tile)
{
    $empty = getEmpty();
    $tmp = $_SESSION['board'][$empty];
    $_SESSION['board'][$empty] = $_SESSION['board'][$tile];
    $_SESSION['board'][$tile] = $tmp;
}

function move_item($item) {
    if (isMoveable($item)) {
        pushTile($item);
        if (checkState()) {
            $_SESSION["solved"] = checkState();
        } else {
            $_SESSION["solved"] = checkState();
        }
    }
}

function solveable() {
    $inversion = 0;
    $item1 = null;
    $item2 = null;

    for ($i = 0; $i < count($_SESSION['board']); $i++ ) {
        $val = $_SESSION['board']["button".$i];
        if ($val == "&nbsp;") {
            $item1 = 9;
        } else {
            $item1 = $val;
        }
        for ($j = $i + 1; $j < count($_SESSION['board']); $j++) {
            $val2 = $_SESSION['board']["button".$j];
            if ($val == "&nbsp;") {
                $item2 = 9;
            } else {
                $item2 = $val;
            }
            if ($item1 && $item2 && $item1 > $item2) {
                $inversion++;
            }
        }

    }
    foreach($_SESSION['board'] as $name => $val) {
        if ($val == "&nbsp;") {
            $item1 = 9;
        } else {
            $item1 = $val;
        }


    }
}

function randomize() {
    do {
        $nums = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
        shuffle($nums);
        for ($i = 0; $i < count($nums); $i++) {
            if ($nums[$i] != 9) {
                $_SESSION['board']['button' . ($i+1)] = $nums[$i];
            } else {
                $_SESSION['board']['button' . ($i+1)] = " ";
            }
        }
    } while (!solveable);
}