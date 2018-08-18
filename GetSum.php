<?php



function GetNumber($m, $n = null)
{
    $have = false;
    if ($n == null ) {
        $sum = 0;
        $tmp = $m;
        while ($tmp > 0) {
            $sum += pow($tmp%10, 3);

            $tmp = $tmp/10;
        }
        if ($sum == $m ) {
            $have = true;
            print ($m);
            print (" ");
        }
    } else {
        for ($i = $m; $i <= $n; ++$i ) {
            $sum = 0;
            $tmp = $i;
            while ($tmp > 0) {
                $sum += pow($tmp%10, 3);

                $tmp = $tmp/10;
            }
            //echo $sum.":".$i."\n";
            //sleep(2);
            if ($sum == $i ) {
                $have = true;
                print ($i);
                print (" ");
            }
        }
    }

    if ($have == false) {
        print ("no");
    }
}
$handel = fopen("php://stdin", "r");
$data = fgets($handel);
while ($data != '') {
    $array = explode(" ", $data);
    if (!empty($array[1]))
        GetNumber($array[0], $array[1]);
    else
        GetNumber($array[0]);
    print ("\r\n");
    $data = fgets($handel);

}
fclose($handel);
?>
