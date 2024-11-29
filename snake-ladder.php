<?php

$grid_size = 5;
$player_size = 3;

$grid_max = $grid_size * $grid_size;
$current_player = 1;
$players = array_fill(1, $player_size, 0);

$output = array();

function play_game($players, $current_player, $grid_max, $grid_size, $output) {
    if ($current_player > count($players)) {
        $current_player = 1;
    }

    $number = rand(1, 6);
    $output[$current_player]['dice_history'][] = $number;

    if ($players[$current_player] + $number <= $grid_max) {
        $players[$current_player] += $number;
        if ($players[$current_player] == $grid_max) {
            $output['winner'] = $current_player;
            $output[$current_player]['pos_history'][] = $players[$current_player];
            $y = intval(($players[$current_player] - 1) / $grid_size);
            $x = ($players[$current_player] - 1) % $grid_size;
            if ($y % 2 != 0) {
                $x = $grid_size - $x - 1;
            }
            $output[$current_player]['cord_history'][] = $x . ',' . $y;
            echo print_r($output, true);
            return;
        }
    }
    
    $output[$current_player]['pos_history'][] = $players[$current_player];
    $y = intval(($players[$current_player] - 1) / $grid_size);
    $x = ($players[$current_player] - 1) % $grid_size;
    if ($y % 2 != 0) {
        $x = $grid_size - $x - 1;
    }
    $output[$current_player]['cord_history'][] = $x . ',' . $y;
    
    play_game($players, $current_player + 1, $grid_max, $grid_size, $output);
}

play_game($players, $current_player, $grid_max, $grid_size, $output);

?>
