<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller for mentor's overview of their students, not the report.
 */
class MentorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $user = Auth::user();
        $trainings = $user->mentoringTrainings();
        $statuses = TrainingController::$statuses;
        $types = TrainingController::$types;
        if($user->isMentor()) return view('mentor.index', compact('trainings', 'user', 'statuses', 'types'));

        abort(403);
    }

}
