<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Winspin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SpinController extends Controller
{
    public function index()
    {

        if (request()->wantsJson()) {
            $data = Reward::all();
            return response()->json($data);
        }

        return view('index');
    }

    public function getLuckyNumber()
    {
        $rewards = Reward::all();
        $results = collect(array_fill(0, 100, 0))->map(function ($item, $index) use ($rewards) {
            return $this->generateRandomNumber($rewards, $index);
        });

        $luckyNumber = $results->shuffle(1000)->random(1);

        // save to db
        Winspin::create([
            'user_id' => 1,
            'number' => $luckyNumber[0]
        ]);

        return response()->json([
            'data' => $luckyNumber[0]
        ]);
    }

    private function generateRandomNumber(Collection $rewards, $numb)
    {
        $circleDeg = 360;
        $start = 0;
        $min = 0;
        $max = floor($circleDeg / $rewards->count());

        foreach ($rewards as $reward) {
            $end = $start + floor(100 * ($reward->chance / 100));
            if ($reward->chance >= 1) {
                if ($numb >= $start && $numb < $end) {
                    return rand($min, $max);
                }
            }

            $start = $end;
            $min = $max;
            $max = $min + floor($circleDeg / count($rewards));
        }
    }
}
