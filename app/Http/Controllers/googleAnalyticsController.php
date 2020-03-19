<?php

  

namespace  App\Http\Controllers;
use Illuminate\Http\Request;
use  Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;
class  googleAnalyticsController  extends  Controller
{

    public  function  analytics(Request  $request){
        $startDate = date_create($request->startDate);
        $endDate = date_create($request->endDate);
        $start = Carbon::createFromFormat('Y-m-d', substr($request->startDate, 0, 10));
        $end = Carbon::createFromFormat('Y-m-d', substr($request->endDate, 0, 10));
        $date = Period::create($start, $end);
        $browser = Analytics::fetchTopBrowsers($date);
        $mostVisitedPages = Analytics::fetchMostVisitedPages($date);
        $visitors = Analytics::fetchVisitorsAndPageViews($date);
        $total_visitors = Analytics::fetchTotalVisitorsAndPageViews($date);
        $top_referrers = Analytics::fetchTopReferrers($date);

        $analyticsData = Analytics::performQuery(
            Period::years(1),
                'ga:sessions',
                [
                'metrics' => 'ga:sessions, ga:pageviews',
                'dimensions' => 'ga:yearMonth,ga:country'
                ]
        );

        $response = Analytics::performQuery(
        Period::create($startDate, $endDate),
        'ga:users,ga:sessions,ga:uniqueEvents,ga:pageviewsPerSession,ga:avgSessionDuration,ga:totalEvents',
        ['dimensions' => 'ga:eventCategory,ga:eventAction,ga:eventLabel,ga:deviceCategory']
        );
        $eventReport = collect($response['rows'] ?? [])->map(function (array  $dateRow) {
                return [
                'eventCategory'=> $dateRow[0],
                'eventAction'=> $dateRow[1],
                'eventLabel'=>$dateRow[2],
                'deviceCategory'=>$dateRow[3],
                'users' => $dateRow[4],
                'sessions' => $dateRow[5],
                'uniqueEvents' =>$dateRow[6],
                'pageviewsPerSession' => $dateRow[7],
                'avgSessionDuration' => $dateRow[8],
                'totalEvents' => $dateRow[9],
                    ];
            });

        $custormQuery =   Analytics::performQuery(
            Period::create($startDate, $endDate),
            'ga:users,ga:uniquePageviews',
            ['dimensions' => 'ga:browser,ga:browserVersion,ga:deviceCategory,ga:country,ga:region,ga:city']
            );

        $custormReport = collect($custormQuery['rows'] ?? [])->map(function (array  $dateRow) {
            return [
                'browser' => $dateRow[0],
                'browserVersion'=> $dateRow[1],
                'deviceCategory' => $dateRow[2],
                'country' => $dateRow[3],
                'region' => $dateRow[4],
                'city' => $dateRow[5],
                'users' => $dateRow[6],
                'uniquePageviews' => $dateRow[7]
            ];
        });

        return  response()->json([  
                                    'custormReport'=>$custormReport,
                                    'eventReport'=>$eventReport,
                                    'browser'=>$browser,
                                    'mostVisitedPages'=>$mostVisitedPages,
                                    'visitors'=>$visitors,
                                    'total_visitors'=>$total_visitors,
                                    'top_referrers'=>$top_referrers,
                                    'analyticsData'=>$analyticsData,

                                ]);

        }

}