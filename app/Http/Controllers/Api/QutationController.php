<?php

namespace App\Http\Controllers\Api;

use App\Models\Qutation;
use Illuminate\Routing\Controller;
use App\Http\Resources\SelectResource;
use App\Http\Resources\QutationResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QutationController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the qutations.
     * @OA\Get(
     *      path="/qutations",
     *      operationId="getQutationsList",
     *      tags={"Qutations"},
     *      summary="Get list of qutations",
     *      description="Returns list of qutations",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/QutationResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $qutations = Qutation::filter()->simplePaginate();
        return QutationResource::collection($qutations);
    }

    /**
     * Display the specified qutation.
     *
     * @OA\Get(
     *      path="/qutations/{id}",
     *      operationId="getQutationById",
     *      tags={"Qutations"},
     *      summary="Get qutation information",
     *      description="Returns qutation data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Qutation id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Qutation")
     *
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     * @param \App\Models\Qutation $qutation
     * @return \App\Http\Resources\QutationResource
     */
    public function show(Qutation $qutation)
    {
        return new QutationResource($qutation);
    }

    /**
     * Display a listing of the resource.
    * @OA\Get(
     *      path="/select/qutations",
     *      operationId="getSelectQutationsList",
     *      tags={"Qutations"},
     *      summary="Get list of Select qutations",
     *      description="Returns list of Select qutations",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/QutationResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function select()
    {
        $qutations = Qutation::filter()->simplePaginate();

        return SelectResource::collection($qutations);
    }
}
