<?php

namespace App\Http\Controllers\Assessment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MbtiOurController extends Controller
{
    public function index(Request $request)
    {
        if ($request->method() == "POST") {
            $data = $request->all();
            print_r($data);
            $e = $i = $s = $n = $t = $f = $j = $p = 0;
            $p = 1;
            $logic = config('logic.mbti_issue_93');
            foreach ($data as $key => $value) {
                if (isset($logic[$p][$value])) {
                    $temp = $logic[$p][$value];
                    switch ($temp) {
                        case 'E':
                            $e++;
                            break;
                        case 'S':
                            $s++;
                            break;
                        case 'T':
                            $t++;
                            break;
                        case 'J':
                            $j++;
                    }
                }
                $p++;
            }
            echo "<hr>";
            echo "E: ".$e."<br>";
            echo "I: ".(21-$e)."<br>";
            echo "S: ".$s."<br>";
            echo "N: ".(26-$s)."<br>";
            echo "T: ".$t."<br>";
            echo "F: ".(24-$t)."<br>";
            echo "J: ".$j."<br>";
            echo "P: ".(22-$j)."<br>";

        } else {
            $a = ['A', 'B'];
            $data = [];
            for ($i = 1; $i < 94; $i++) {
                $data[$i]['id'] = $i;
                $data[$i]['answer'] = $a[array_rand($a)];
            }

            return view('assessment.mnti.index', compact('data'));
        }
    }
}
