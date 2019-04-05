<?php

namespace App\Http\Controllers;

use App\Statistic;
use App\Users;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Charts\LatestUsers;

class StatisticsController extends Controller
{
    /* Restrict the access to this resource just to admin, the store method is called by Laravel Forge Deamon */
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['store']]);
    }

    /***************************************************************************/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lastUpdateStatistic = Statistic::find(\DB::table('statistics')->max('id'));

        $lastIDUpdatedStats = \DB::table('statistics')->max('id');
        
        $data = collect([]); // Could also be an array
        $labels = array();
        for ($days_backwards = 12; $days_backwards >= 0; $days_backwards--) {
            $dayStat = Statistic::find($lastIDUpdatedStats-$days_backwards);
            $data->push($dayStat->registered_users_number);
            $labels[] = Carbon::parse($dayStat->created_at)->format('d/m');
        }
        
        


        $chart = new LatestUsers;
        
        /*$chart->labels(['One', 'Two', 'Three', 'Four']);
        $chart->dataset('My dataset', 'line', [1, 2, 3, 7]);
        $chart->dataset('My dataset 2', 'line', [4, 3, 2, 1]);*/

        $chart->labels($labels);
        $dataset = $chart->dataset('Users number', 'line', $data);
        
        //$dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838']));
        //$dataset->color(collect(['#7d5fff','#32ff7e', '#ff4d4d']));
        $dataset->options([
            'borderColor' => '#2669A0',
        ]);



        return view('stats.index')
            ->with('statsDatas', $lastUpdateStatistic)
            ->with('chart', $chart);
    }

    /***************************************************************************/

    // THIS METHOD - HAS BEEN SUBSTITUTED BY THE STATIC METHOD UPDATE STATISTICS IN THE STATISTIC MODEL

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Statistic::updateStatistics();
    }
}
