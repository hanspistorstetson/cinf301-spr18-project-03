<?php
/**
 * Created by PhpStorm.
 * User: hanspistor
 * Date: 2/25/18
 * Time: 1:57 PM
 */

function game() {
    $board = array(
        "top" => array(
            "tl" => "<button class=\"btn btn-secondary custombutton\">1</button>",
            "tm" => "<button class=\"btn btn-secondary custombutton\">2</button>",
            "tr" => "<button class=\"btn btn-secondary custombutton\">3</button>",
        ),
        "middle" => array(
            "ml" => "<button class=\"btn btn-secondary custombutton\">4</button>",
            "mm" => "<button class=\"btn btn-secondary custombutton\">5</button>",
            "mr" => "<button class=\"btn btn-secondary custombutton\">6</button>",
        ),
        "bottom" => array(
            "bl" => "<button class=\"btn btn-secondary custombutton\">7</button>",
            "bm" => "<button class=\"btn btn-secondary custombutton\">8</button>",
            "br" => "<button class=\"btn btn-secondary custombutton\">&nbsp;</button>",
        )
    );
    display_board($board);
}
s
function display_board($board) {
    echo "<div id=\"puzzle\" class=\"container\">";
    foreach($board as $key => $value) {
        echo "<div class=\"row justify-content-md-center justify-content-sm-center\">";
        foreach($value as $pos => $tile) {
            echo $tile;
        }
        echo "</div>";
    }
    echo "</div>";
}