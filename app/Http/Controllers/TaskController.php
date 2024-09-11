<?php

namespace App\Http\Controllers;

use App\Models\Models\Tasks;
use \App\Models\Utills;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tasks = Tasks::all();

        return response()->json(['tasks' => $tasks]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $task = Tasks::find($id);
            if ($task == null) {
                return response()->json([
                    'msg' => 'Tarefa não encontrada',
                    'type' => 'warning'
                ]);
            }

            return $task;
        } catch (\Exception $exception) {
            return response()->json(Utills::returnException($exception));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $task = Tasks::create($data);
            return $task;
        }catch (\Exception $exception){
            return response()->json(Utills::returnException($exception));
        }

    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $task = Tasks::find($id);
            if ($data['finalDate'] == null) {
                $data['status'] = 1;
            } else if (strtotime($data['finalDate']) > strtotime($data['expectedFinalDate'])) {
                $data['status'] = 4;
            } else {
                $data['status'] = 3;
            }

            $task->update($data);

            return $task;
        }catch (\Exception $exception){
            return response()->json(Utills::returnException($exception));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete = Tasks::where('id', $id)->delete();
        if ($delete) {

            return response()->json([
                'msg' => 'deletado com sucesso',
                'type' => 'warning'
            ]);
        } else {
            return response()->json([
                'msg' => 'deletado com sucesso',
                'type' => 'error'
            ]);
        }
    }
}
