<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use Validator;
use App\MemberReg;
use Illuminate\Support\Facades\Auth;

class MemberRegController
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
   public function index()
    {
      //Get list of Member Reg
      $data = MemberReg::all();
      $message = 'Member Reg retrieved successfully.';
      $status = true;
      //Call function for response data
      $response = $this->response($status, $data, $message);
      return $response;
    }
    /**
     * Store a newly created Member Reg in the database.
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
            'org_id' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $data = MemberReg::create($input);
        $message = 'Member Reg created successfully.';
        $status = true;

        //Call function for response data
        $response = $this->response($status, $data, $message);
        return $response;
    }
    /**
     * Update the specified Member Reg in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $data = MemberReg::find($id);
        $data->update($input);

        return response()->json(['success' => $data], $this->successStatus);
    }
    /**
     * Display the specified Member Reg.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MemberReg::find($id);
        //Check if the Member Reg found or not.
        if (is_null($data)) {
            $message = 'Member Reg not found.';
            $status = false;
            $response = $this->response($status, $data, $message);
            return $response;
        }
        $message = 'Member Reg retrieved successfully.';
        $status = true;

        //Call function for response data
        $response = $this->response($status, $data, $message);
        return $response;
    }
    /**
     * Remove the specified Member Reg from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete data
        $data = MemberReg::findOrFail($id);
        $data->delete();
        $message = 'Member Reg deleted successfully.';
        $status = true;

        //Call function for response data
        $response = $this->response($status, $data, $message);
        return $response;
    }
    /**
     * Response Member Reg
     *
     * @param $status
     * @param $MemberReg
     * @param $message
     * @return \Illuminate\Http\Response
     */
    public function response($status, $data, $message)
    {
        //Response Member Reg structure
        $return['success'] = $status;
        $return['data'] = $data;
        $return['message'] = $message;
        return $return;
    }
}