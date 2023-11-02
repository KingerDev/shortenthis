<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class FindUrlController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $keyword = $request->only(['url']);

        $prefix = $this->getLastUrlSegment($keyword['url']);

        $url = Url::where('original_url', $keyword['url'])
            ->orWhere('prefix', $prefix)
            ->first();

        if ($url) {
            return redirect()->route('url.show', $url->prefix);
        } else {
            return redirect()
                ->back()
                ->with('error', 'Could not get the url');
        }

    }

    private function getLastUrlSegment(string $url)
    {
        $parsedUrl = parse_url($url);

        if (isset($parsedUrl['path'])) {
            // Get the path and remove any leading or trailing slashes
            $path = trim($parsedUrl['path'], '/');

            // Split the path into segments
            $segments = explode('/', $path);

            // Get the last segment
            $lastSegment = end($segments);

            return $lastSegment;
        } else {
            return null;
        }
    }
}
