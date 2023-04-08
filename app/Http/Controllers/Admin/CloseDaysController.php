<?php

namespace App\Http\Controllers\Admin;

use App\CloseDay;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CloseDayRepository;
use App\Rules\IsDateUnique;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CloseDaysController extends Controller
{
    public function __construct(private CloseDayRepository $closeDayRepository)
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = CloseDay::get();

        return view('admin.close.index', compact('dates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $validator = Validator::make([], []);

        request()->validate([
            'start' => ['date', new IsDateUnique($start), 'before:end'],
            'end' => ['date',  new IsDateUnique($end), 'after:start'],
        ]);

        if ($this->closeDayRepository->hasDateRange($start, $end) > 0) {
            $this->closeDayRepository->insertAllDatesFromRange($start, $end);
        } else {
            if ($this->closeDayRepository->dateIsInRange($start, $end)) {
                $validator->errors()->add('in_between', 'Two dates are in between of other dates');
                throw new ValidationException($validator);
            }

            $this->closeDayRepository->addCloseDay(['start' => $start, 'end' => $end]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'start' => 'date',
            'end' => 'date',
        ]);

        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $updated = CloseDay::find($id)->update([
            'start' => $start,
            'end' => $end,
        ]);

        return response()->json(['success' => $updated]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CloseDay $close)
    {
        return response()->json(['success' => $close->delete()]);
    }
}
