<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBlogCategoriesAPIRequest;
use App\Http\Requests\API\UpdateBlogCategoriesAPIRequest;
use App\Models\BlogCategories;
use App\Repositories\BlogCategoriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BlogCategoriesController
 * @package App\Http\Controllers\API
 */

class BlogCategoriesAPIController extends InfyOmBaseController
{
    /** @var  BlogCategoriesRepository */
    private $blogCategoriesRepository;

    public function __construct(BlogCategoriesRepository $blogCategoriesRepo)
    {
        $this->blogCategoriesRepository = $blogCategoriesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/blogCategories",
     *      summary="Get a listing of the BlogCategories.",
     *      tags={"BlogCategories"},
     *      description="Get all BlogCategories",
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
     *                  @SWG\Items(ref="#/definitions/BlogCategories")
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
        $this->blogCategoriesRepository->pushCriteria(new RequestCriteria($request));
        $this->blogCategoriesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $blogCategories = $this->blogCategoriesRepository->all();

        return $this->sendResponse($blogCategories->toArray(), 'BlogCategories retrieved successfully');
    }

    /**
     * @param CreateBlogCategoriesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/blogCategories",
     *      summary="Store a newly created BlogCategories in storage",
     *      tags={"BlogCategories"},
     *      description="Store BlogCategories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BlogCategories that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BlogCategories")
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
     *                  ref="#/definitions/BlogCategories"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBlogCategoriesAPIRequest $request)
    {
        $input = $request->all();

        $blogCategories = $this->blogCategoriesRepository->create($input);

        return $this->sendResponse($blogCategories->toArray(), 'BlogCategories saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/blogCategories/{id}",
     *      summary="Display the specified BlogCategories",
     *      tags={"BlogCategories"},
     *      description="Get BlogCategories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BlogCategories",
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
     *                  ref="#/definitions/BlogCategories"
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
        /** @var BlogCategories $blogCategories */
        $blogCategories = $this->blogCategoriesRepository->find($id);

        if (empty($blogCategories)) {
            return Response::json(ResponseUtil::makeError('BlogCategories not found'), 404);
        }

        return $this->sendResponse($blogCategories->toArray(), 'BlogCategories retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBlogCategoriesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/blogCategories/{id}",
     *      summary="Update the specified BlogCategories in storage",
     *      tags={"BlogCategories"},
     *      description="Update BlogCategories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BlogCategories",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BlogCategories that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BlogCategories")
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
     *                  ref="#/definitions/BlogCategories"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBlogCategoriesAPIRequest $request)
    {
        $input = $request->all();

        /** @var BlogCategories $blogCategories */
        $blogCategories = $this->blogCategoriesRepository->find($id);

        if (empty($blogCategories)) {
            return Response::json(ResponseUtil::makeError('BlogCategories not found'), 404);
        }

        $blogCategories = $this->blogCategoriesRepository->update($input, $id);

        return $this->sendResponse($blogCategories->toArray(), 'BlogCategories updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/blogCategories/{id}",
     *      summary="Remove the specified BlogCategories from storage",
     *      tags={"BlogCategories"},
     *      description="Delete BlogCategories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BlogCategories",
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
        /** @var BlogCategories $blogCategories */
        $blogCategories = $this->blogCategoriesRepository->find($id);

        if (empty($blogCategories)) {
            return Response::json(ResponseUtil::makeError('BlogCategories not found'), 404);
        }

        $blogCategories->delete();

        return $this->sendResponse($id, 'BlogCategories deleted successfully');
    }
}
