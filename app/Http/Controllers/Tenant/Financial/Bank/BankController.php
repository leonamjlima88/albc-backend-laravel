<?php

namespace App\Http\Controllers\Tenant\Financial\Bank;

use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\Tenant\Financial\Bank\BankDto;
use App\Services\Tenant\Financial\Bank\BankService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BankController extends Controller
{
    /**
     * Undocumented function
     *
     * @param BankService $service
     */
    public function __construct(
        protected BankService $service
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

    public function store(BankDto $dto): JsonResponse
    {
        return $this->responseSuccess(
            $this->service->store($dto),
            Response::HTTP_CREATED
        );
    }

    /**
     * Undocumented function
     *
     * @param BankDto $dto
     * @param integer $id
     * @return JsonResponse
     */
    public function update(BankDto $dto, int $id): JsonResponse
    {
        return $this->responseSuccess(
            $this->service->update($id, $dto)
        );
    }
}
