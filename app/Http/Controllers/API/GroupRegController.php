<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use Validator;
use App\GroupReg;
use Illuminate\Support\Facades\Auth;

class GroupRegController
{
    public $successStatus = 200;

 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
   public function index()
    {
      //Get list of Group Reg
      $data = GroupReg::all();
      $message = 'Group Reg retrieved successfully.';
      $status = true;
      //Call function for response data
      $response = $this->response($status, $data, $message);
      return $response;
    }
    /**
     * Store a newly created Group Reg in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //Get request data
     $input = $request->all();

     //Validate requested data
     $validator = Validator::make($input, [
            'name' => 'required',
            'address' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $data = GroupReg::create($input);
        $message = 'Group Reg created successfully.';
        $status = true;

        //Call function for response data
        $response = $this->response($status, $data, $message);
        return $response;
    }
    /**
     * Update the specified Group Reg in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $data = GroupReg::find($id);
        $data->update($input);

        return response()->json(['success' => $data], $this->successStatus);
    }
    /**
     * Display the specified Group Reg.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = GroupReg::find($id);
        //Check if the Group Reg found or not.
        if (is_null($data)) {
            $message = 'Group Reg not found.';
            $status = false;
            $response = $this->response($status, $data, $message);
            return $response;
        }
        $message = 'Group Reg retrieved successfully.';
        $status = true;

        //Call function for response data
        $response = $this->response($status, $data, $message);
        return $response;
    }
    /**
     * Remove the specified Group Reg from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete data
        $data = GroupReg::findOrFail($id);
        $data->delete();
        $message = 'Group Reg deleted successfully.';
        $status = true;

        //Call function for response data
        $response = $this->response($status, $data, $message);
        return $response;
    }
    /**
     * Response Group Reg
     *
     * @param $status
     * @param $GroupReg
     * @param $message
     * @return \Illuminate\Http\Response
     */
    public function response($status, $data, $message)
    {
        //Response Group Reg structure
        $return['success'] = $status;
        $return['data'] = $data;
        $return['message'] = $message;
        return $return;
    }
}