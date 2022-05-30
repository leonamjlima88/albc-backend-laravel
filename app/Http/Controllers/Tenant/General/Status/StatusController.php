<?php

namespace App\Http\Controllers\Tenant\General\Status;

use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\Tenant\General\Status\StatusDto;
use App\Services\Tenant\General\Status\StatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatusController extends Controller
{
    /**
     * Undocumented function
     *
     * @param StatusService $service
     */
    public function __construct(
        protected StatusService $service
    ) {
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->service->destroy($id) 
            ? $this->responseSuccess(code: Response::HTTP_NO_CONTENT)
            : $this->responseError(code: Response::HTTP_NOT_FOUND);
    }

    public function index(Request $request)
    {
        return $this->responseSuccess(
            $this->service->index(
                $request->input('page'),
                $request->input('filter'),
            )
        );
    }

    public function show(int $id): JsonResponse
    {
        return ($dto = $this->service->show($id))
            ? $this->responseSuccess($dto)
            : $this->responseError(code: Response::HTTP_NOT_FOUND);
    }

    public function store(StatusDto $dto): JsonResponse
    {
        return $this->responseSuccess(
            $this->service->store($dto),
            Response::HTTP_CREATED
        );
    }

    /**
     * Undocumented function
     *
     * @param StatusDto $dto
     * @param integer $id
     * @return JsonResponse
     */
    public function update(StatusDto $dto, int $id): JsonResponse
    {
        return $this->responseSuccess(
            $this->service->update($id, $dto)
        );
    }
}
