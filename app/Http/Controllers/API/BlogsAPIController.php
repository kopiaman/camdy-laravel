<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBlogsAPIRequest;
use App\Http\Requests\API\UpdateBlogsAPIRequest;
use App\Models\Blogs;
use App\Models\BlogCategories;
use App\Repositories\BlogsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BlogsController
 * @package App\Http\Controllers\API
 */

class BlogsAPIController extends InfyOmBaseController
{
    /** @var  BlogsRepository */
    private $blogsRepository;

    public function __construct(BlogsRepository $blogsRepo)
    {
        $this->blogsRepository = $blogsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/blogs",
     *      summary="Get a listing of the Blogs.",
     *      tags={"Blogs"},
     *      description="Get all Blogs",
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
     *                  @SWG\Items(ref="#/definitions/Blogs")
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
       // $this->blogsRepository->pushCriteria(new RequestCriteria($request));
       // $this->blogsRepository->pushCriteria(new LimitOffsetCriteria($request));
    
       // $blogs = $this->blogsRepository->all();
         return $blogs = Blogs::with("blogcategories")->get();
       // return $this->sendResponse($blogs->blogcategories->toArray(), 'Blogs retrieved successfully');
    }

    /**
     * @param CreateBlogsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/blogs",
     *      summary="Store a newly created Blogs in storage",
     *      tags={"Blogs"},
     *      description="Store Blogs",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Blogs that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Blogs")
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
     *                  ref="#/definitions/Blogs"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBlogsAPIRequest $request)
    {
        $input = $request->all();

        $blogs = $this->blogsRepository->create($input);

        return $this->sendResponse($blogs->toArray(), 'Blogs saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/blogs/{id}",
     *      summary="Display the specified Blogs",
     *      tags={"Blogs"},
     *      description="Get Blogs",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Blogs",
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
     *                  ref="#/definitions/Blogs"
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
        /** @var Blogs $blogs */
        $blogs = $this->blogsRepository->find($id);

        if (empty($blogs)) {
            return Response::json(ResponseUtil::makeError('Blogs not found'), 404);
        }

        return $this->sendResponse($blogs->toArray(), 'Blogs retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBlogsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/blogs/{id}",
     *      summary="Update the specified Blogs in storage",
     *      tags={"Blogs"},
     *      description="Update Blogs",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Blogs",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Blogs that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Blogs")
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
     *                  ref="#/definitions/Blogs"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBlogsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Blogs $blogs */
        $blogs = $this->blogsRepository->find($id);

        if (empty($blogs)) {
            return Response::json(ResponseUtil::makeError('Blogs not found'), 404);
        }

        $blogs = $this->blogsRepository->update($input, $id);

        return $this->sendResponse($blogs->toArray(), 'Blogs updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/blogs/{id}",
     *      summary="Remove the specified Blogs from storage",
     *      tags={"Blogs"},
     *      description="Delete Blogs",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Blogs",
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
        /** @var Blogs $blogs */
        $blogs = $this->blogsRepository->find($id);

        if (empty($blogs)) {
            return Response::json(ResponseUtil::makeError('Blogs not found'), 404);
        }

        $blogs->delete();

        return $this->sendResponse($id, 'Blogs deleted successfully');
    }
}
