<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationsResource;
use App\Models\Notifications;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;



class NotificationsApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.basic');
    }

    public function index()
    {
        $results = Notifications::all()->where('user_id', Auth::id());

       return NotificationsResource::collection($results)->toJson();

    }

    public function store(Request $request):NotificationsResource
    {

        $this->authorize('rightsToExecute', Notifications::class);

        $request->validate([
            'user_id' => ['required'],
            'category_id' => ['required']
        ]) ;

       $newUserNotification = Notifications::updateOrCreate([
            'user_id' => $request->input('user_id'),
            'category_id' => $request->input('category_id')
        ]);

        return new NotificationsResource($newUserNotification);

    }

    public function show($id,Notifications $notifications)
    {
        $this->authorize('rightsToExecute', $notifications);

//        $results = Notifications::where('user_id', Auth::id())->where('id' , $id)->get();
//
//       if ($results->IsEmpty()){
//           return new JsonResponse(null, Response::HTTP_FORBIDDEN);
//       }

       return NotificationsResource::collection($notifications)->toJson();

    }

    public function update( $id, Request $request ):NotificationsResource
    {

        $this->authorize('rightsToExecute', Notifications::class);

        $userToUpdate = Notifications::find($id);
        $userToUpdate->user_id = $request->input('user_id');
        $userToUpdate->category_id = $request->input('category_id');
        $userToUpdate->save();  // Update the data

        return new NotificationsResource($userToUpdate);

    }

    public function destroy($id): JsonResponse
    {

        $this->authorize('rightsToExecute', Notifications::class);

//        $results = Notifications::where('user_id', Auth::id())->where('id' , $id)->get();
//
//        if ($results->IsEmpty()){
//            return new JsonResponse(null, Response::HTTP_FORBIDDEN);
//        }

        Notifications::find($id)->delete();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);

    }
}
