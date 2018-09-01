<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ItemNotFoundException;
use App\Http\HttpCode;
use App\Http\Transformers\Item\ItemIndexTransformer;
use App\Http\Transformers\Item\ItemTransformer;
use App\ItemManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @param Request $request
     * @param ItemManager $itemManager
     * @return JsonResponse
     */
    public function store(Request $request, ItemManager $itemManager): JsonResponse
    {
        $item = $itemManager->addItem($request->get('description'));

        return $this->responseSuccess(new ItemTransformer($item));
    }

    /**
     * @param int $id
     * @param ItemManager $itemManager
     * @return JsonResponse
     */
    public function show(int $id, ItemManager $itemManager): JsonResponse
    {
        $item = $itemManager->getItem($id);

        return $this->responseSuccess(new ItemTransformer($item));
    }

    /**
     * @param int $id
     * @param ItemManager $itemManager
     * @return JsonResponse
     */
    public function finish(int $id, ItemManager $itemManager): JsonResponse
    {
        try {
            $item = $itemManager->finishItem($id);
        } catch (ItemNotFoundException $e) {
            return $this->responseError($e, HttpCode::NOT_FOUND);
        }

        return $this->responseSuccess(new ItemTransformer($item));
    }

    /**
     * @param ItemManager $itemManager
     * @return JsonResponse
     */
    public function indexFinished(ItemManager $itemManager): JsonResponse
    {
        $items = $itemManager->getFinishedItems();

        return $this->responseSuccess(new ItemIndexTransformer($items));
    }

    /**
     * @param ItemManager $itemManager
     * @return JsonResponse
     */
    public function indexUnfinished(ItemManager $itemManager): JsonResponse
    {
        $items = $itemManager->getUnfinishedItems();

        return $this->responseSuccess(new ItemIndexTransformer($items));
    }
}
