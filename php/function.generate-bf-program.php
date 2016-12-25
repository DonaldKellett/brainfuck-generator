<?php

/*
  Brainfuck Code Generator
  (c) Donald Leung.  All rights reserved.
  MIT License
*/

function generate_bf_program(string $s): string {
  if (empty($s)) return "";
  $uniq = function ($a) {
    $result = [];
    for ($i = 0; $i < count($a); $i++) {
      if (!in_array($a[$i], $result)) array_push($result, $a[$i]);
    }
    return $result;
  };
  $program = "++++++++++";
  $cells = array_merge([0], $uniq(array_map(function ($c) {return 10 * round(ord($c) / 10);}, str_split($s))));
  $program .= "[";
  for ($i = 1; $i < count($cells); $i++) $program .= ">" . str_repeat("+", $cells[$i] / 10);
  $program .= str_repeat("<", count($cells) - 1) . "-]";
  $curri = 0;
  for ($i = 0; $i < strlen($s); $i++) {
    $corri = array_search(min($dists = array_map(function ($c) use ($s, $i) {return abs(ord($s[$i]) - $c);}, $cells)), $dists);
    $program .= $corri > $curri ? str_repeat(">", $corri - $curri) : str_repeat("<", $curri - $corri);
    if (ord($s[$i]) > $cells[$corri]) {
      $program .= str_repeat("+", ord($s[$i]) - $cells[$corri]) . ".";
    } else {
      $program .= str_repeat("-", $cells[$corri] - ord($s[$i])) . ".";
    }
    $cells[$corri] = ord($s[$i]);
    $curri = $corri;
  }
  return $program;
}

?>
