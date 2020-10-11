<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BodyStat;

class BodyStatsController extends Controller
{
    // Index
    public function index()
    {
      return view('home', ['pastResults' => $this->getPastResults()]);
    }

    // Result
    public function result(Request $request)
    {
      request()->validate([
        'date' => 'required',
        'wight' => 'required',
        'fat' => 'required',
        'muscle' => 'nullable',
      ]);

      // Get the results
      $result = [
        'date' => request('date'),
        'wight' => request('wight'),
        'fat_percent' => request('fat'),
        'fat_lb' => $this->lbCalc(request('wight'), request('fat')),
      ];

      if (!empty(request('muscle'))) {
        $result['muscle_percent'] = request('muscle');
        $result['muscle_lb'] = $this->lbCalc(request('wight'), request('muscle'));
      }
      
      return view('home', ['pastResults' => $this->getPastResults(), 'result' => $result]);
    }

    // Save the results
    public function save(Request $result)
    {
      $bodyStat = new BodyStat();

      $bodyStat->date = $result['date'];
      $bodyStat->wight = $result['wight'];
      $bodyStat->fat_percent = $result['fat_percent'];
      $bodyStat->fat_lb = $result['fat_lb'];

      if (!empty($result['muscle_percent'])) {
        $bodyStat->muscle_percent = $result['muscle_percent'];
        $bodyStat->muscle_lb = $result['muscle_lb'];
      }

      $bodyStat->save();

      return redirect()->route('body_stats.index', ['pastResults' => $this->getPastResults()]);
    }

    // Get passed results
    public function getPastResults()
    {
      $pastResults = BodyStat::orderBy('date', 'desc')->get();

      return $pastResults;
    }

    // Calculate the lb from a % 
    public function lbCalc($wight, $percent)
    {
      // Calc 1% of the wight
      $onePercent = $wight / 100;

      $lb = $onePercent * $percent;

      return $lb;
    }
}
