<?php
    namespace App\Http\Controllers\API;

    use Illuminate\Http\Request;
    use App\User;
    use Illuminate\Support\Facades\Auth;
    use Validator;

    class UserAPIController
    {
        public $successStatus = 200;
        /**
         * List user api
         *
         * @return \Illuminate\Http\Response
         */
        public function index(){
            $user = User::all();
            return response()->json(['success' => $user], $this->successStatus);
        }

        /**
         * login api
         *
         * @return \Illuminate\Http\Response
         */
        public function login(){
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
                $user = Auth::user();
                $success['token'] =  $user->createToken('crudapp')->accessToken;
                $token =  $user->createToken('crudapp')->accessToken;
                return response()->json(['success' => true, 'message' => "Authorised", "token" => $token], $this->successStatus);
            }
            else{
                return response()->json(['success' => false, 'message' => "Unauthorised"], 401);
            }
        }

        /**
         * Register api
         *
         * @return \Illuminate\Http\Response
         */
        public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 401);
            }
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('crudapp')-> accessToken;
            $token =  $user->createToken('crudapp')->accessToken;
            $success['email'] =  $user->email;
            $success['name'] =  $user->name;
            return response()->json(['success'=> true, "message" => "Registration succeeded", "token" => $token], $this->successStatus);
        }

        /**
         * Update user details api
         *
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $input = $request->all();

            $user = User::findOrFail($id);
            $user->update($input);

            return response()->json(['success' => $user], $this->successStatus);
        }

        /**
         * Delete user api
         *
         * @return \Illuminate\Http\Response
         */
        public function delete(Request $request, $id)
        {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['success'=> true, "message" => "User deleted"], $this->successStatus);
        }
    }
