<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\UrlClick;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|url',
        ]);

        if ($request->user()) {

            $request->user()->urls()->create([
                'original_url' => $validated['url'],
                'prefix' => Str::random(5),
            ]);

            return redirect()
                ->route('dashboard')
                ->with('success', 'Link created successfully');
        } else {

            $url = Url::create([
                'original_url' => $validated['url'],
                'prefix' => Str::random(5),
            ]);

            return redirect()
                ->route('url.show', [$url->prefix])
                ->with('success', 'Url created successfully');
        }
    }

    public function show(String $prefix)
    {
        $url_click_model = new \App\Models\UrlClick;

        $url = Url::where('prefix', $prefix)
            ->withCount('clicks')
            ->first();

        $clicks = [];

        if ($url) {
            $clicks = $url->clicks()->orderBy('created_at', 'desc')->simplePaginate(2);
        }

        return Inertia::render('Url/Show', [
            'url' => $url,
            'clicks' => $clicks,
            'uniqueVisits' => UrlClick::distinct('user_agent')->where('url_id', $url->id)->count(),
            'qrScans' => UrlClick::where('url_id', $url->id)->where('type', 'qr')->count(),
            'dailyAverage' => $url_click_model->getDailyAverage($url->id),
            'weeklyAverage' => $url_click_model->getWeeklyAverage($url->id),
            'monthlyAverage' => $url_click_model->getMonthlyAverage($url->id),
            'siteUrl' => route('/'),
        ]);
    }

    public function edit(Request $request, Url $url)
    {
        return Inertia::render('Url/Edit', [
            'url' => $url,
        ]);
    }

    public function update(Request $request, Url $url)
    {
        $url->update(
            $request->validate([
                'original_url' => 'required|url',
                'clicks_limit' => 'integer|min:1'
            ])
        );

        return redirect()
            ->route('dashboard')
            ->with('success', 'Url updated successfully');
    }

    public function destroy(Url $url)
    {
        $url->delete();

        return redirect()
            ->back()
            ->with('success', 'Url deleted successfully');
    }
}
