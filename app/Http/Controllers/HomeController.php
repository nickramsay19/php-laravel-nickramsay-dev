<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

use App\Models\Post;

class HomeController extends Controller {
    protected $log;

    public function __construct() {
        $controllerLog = Log::build([
          'driver' => 'single',
          'path' => storage_path('logs/homecontroller.log'),
        ]);

        $this->log = Log::stack(['stack', $controllerLog]);
    }

    public function index(): View {
        Gate::authorize('viewAny', Post::class);

        return view('pages.index', [
            'posts' => Post::viewable()->with('tags')->take(10)->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
