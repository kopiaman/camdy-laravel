<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFaqsAPIRequest;
use App\Http\Requests\API\UpdateFaqsAPIRequest;
use App\Models\Faqs;
use App\Repositories\FaqsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FaqsController
 * @package App\Http\Controllers\API
 */

class FaqsAPIController extends InfyOmBaseController
{
    /** @var  FaqsRepository */
    private $faqsRepository;

    public function __construct(FaqsRepository $faqsRepo)
    {
        $this->faqsRepository = $faqsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/faqs",
     *      summary="Get a listing of the Faqs.",
     *      tags={"Faqs"},
     *      description="Get all Faqs",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Faqs")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->faqsRepository->pushCriteria(new RequestCriteria($request));
        $this->faqsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $faqs = $this->faqsRepository->all();

        return $this->sendResponse($faqs->toArray(), 'Faqs retrieved successfully');
    }

    /**
     * @param CreateFaqsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/faqs",
     *      summary="Store a newly created Faqs in storage",
     *      tags={"Faqs"},
     *      description="Store Faqs",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Faqs that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Faqs")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Faqs"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFaqsAPIRequest $request)
    {
        $input = $request->all();

        $faqs = $this->faqsRepository->create($input);

        return $this->sendResponse($faqs->toArray(), 'Faqs saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/faqs/{id}",
     *      summary="Display the specified Faqs",
     *      tags={"Faqs"},
     *      description="Get Faqs",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Faqs",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Faqs"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Faqs $faqs */
        $faqs = $this->faqsRepository->find($id);

        if (empty($faqs)) {
            return Response::json(ResponseUtil::makeError('Faqs not found'), 404);
        }

        return $this->sendResponse($faqs->toArray(), 'Faqs retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateFaqsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/faqs/{id}",
     *      summary="Update the specified Faqs in storage",
     *      tags={"Faqs"},
     *      description="Update Faqs",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Faqs",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Faqs that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Faqs")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Faqs"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFaqsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Faqs $faqs */
        $faqs = $this->faqsRepository->find($id);

        if (empty($faqs)) {
            return Response::json(ResponseUtil::makeError('Faqs not found'), 404);
        }

        $faqs = $this->faqsRepository->update($input, $id);

        return $this->sendResponse($faqs->toArray(), 'Faqs updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/faqs/{id}",
     *      summary="Remove the specified Faqs from storage",
     *      tags={"Faqs"},
     *      description="Delete Faqs",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Faqs",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Faqs $faqs */
        $faqs = $this->faqsRepository->find($id);

        if (empty($faqs)) {
            return Response::json(ResponseUtil::makeError('Faqs not found'), 404);
        }

        $faqs->delete();

        return $this->sendResponse($id, 'Faqs deleted successfully');
    }
}
