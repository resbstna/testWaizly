<?php

namespace App\Http\Controllers\Api;

use App\Models\Tasktodo;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;

class TasktodoController extends BaseController
{
    public function index(Request $request)
    {

        // check error
        try {
            // search Tasktodo and paginate 10
            $tasktodo = Tasktodo::where([
                ['title', '!=', Null],
                [function ($query) use ($request) {
                    if (($s = $request->s)) {
                        $query->orWhere('title', 'LIKE', '%' . $s . '%')
                            ->get();
                    }
                }]
            ])->paginate(10);

            return $this->sendResponse($tasktodo, 'Tasktodo retrieved successfully.');
        } catch (\Exception $ex) {
            return $this->sendError('Something went wrong. Please try again later.', [], 500);
        }
    }

    public function store(Request $request)
    {

        // check error
        try {
            //add Tasktodo
            $v = Validator::make($request->all(), [
                'title' => 'required',
                'start_date' => 'required',
            ]);

            //check validation
            if ($v->fails()) {
                return $this->sendError('Validation Error.', $v->errors(), 422);
            }


            $tasktodo = Tasktodo::create($request->all());

            return $this->sendResponse($tasktodo, 'Tasktodo created successfully.');
        } catch (\Exception $ex) {
            return $this->sendError('Something went wrong. Please try again later.', $ex, 500);
        }
    }

    public function show($id)
    {

        // check error
        try {
            // show Tasktodo 
            $tasktodo = Tasktodo::find($id);

            //check jika Tasktodo tidak ada
            if (is_null($tasktodo)) {
                return $this->sendError('Tasktodo not found.', [], 422);
            }

            return $this->sendResponse($tasktodo, 'Tasktodo retrieved successfully.');
        } catch (\Exception $ex) {
            return $this->sendError('Something went wrong. Please try again later.', [], 500);
        }
    }

    public function update(Request $request, Tasktodo $tasktodo)
    {

        // check error
        try {
            // validation update
            $v = Validator::make($request->all(), [
                'title' => 'required',
                'start_date' => 'required',
            ]);

            //check validation
            if ($v->fails()) {
                return $this->sendError('Validation Error.', $v->errors(), 422);
            }

            $tasktodo->title = $request->title;
            $tasktodo->start_date = $request->start_date;
            $tasktodo->status = $request->status;
            $tasktodo->save();

            return $this->sendResponse($tasktodo, 'Tasktodo updated successfully.');
        } catch (\Exception $ex) {
            return $this->sendError('Something went wrong. Please try again later.', $ex, 500);
        }
    }


    public function destroy(Tasktodo $tasktodo)
    {
        // check error
        try {

            $tasktodo->delete();

            return $this->sendResponse($tasktodo, 'Tasktodo deleted successfully.');
        } catch (\Exception $ex) {
            return $this->sendError('Something went wrong. Please try again later.', [], 500);
        }
    }
}
