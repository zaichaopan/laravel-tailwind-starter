<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class NestedCommentsService
{
    protected $model;

    protected $request;

    public function __construct(Model $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function getNestedComments($page, $perPage)
    {
        $allComments = $this->model->comments();
        $groupedComments = $allComments->groupBy('parent_id');
        $rootComments = $groupedComments->get(null)->forPage($page, $perPage);
        $returnedCommentIds = $this->buildNestedIds($rootComments, $groupedComments);
        $groupedReturnedComments = $allComments->whereIn('id', $returnedCommentIds)->get()->groupBy('parent_id');
        $rootReturnedComments = $groupedReturnedComments->get(null);
        return $this->buildNestedComments($rootReturnedComments, $groupedReturnedComments);
    }

    public function buildNestedIds($rootComments, $groupedComments, &$ids = [])
    {
        foreach ($rootComments as $rootComment) {
            $ids[] = $rootComment->id;

            if ($replies = $groupedComments->get($rootComment->id)) {
                $this->buildNestedIds($replies, $groupedComments, $ids);
            }
        }

        return $ids;
    }

    public function buildNestedComments($rootComments, $groupedAllComments)
    {
        return $rootComments->each(function ($rootComment) use ($groupedAllComments) {
            if ($replies = $groupedAllComments->get($rootComment->id)) {
                $rootComment->children = $replies;
                $this->buildNestedComments($replies, $groupedAllComments);
            }
        });
    }

    public function paginate()
    {
        $page = $this->request->page;
        $perPage = $this->request->perPage;
        $path = $this->request->url();
        $query = $this->request->query();

        $comments = $this->getNestedComments($page, $perPage);
        $totalPage = $this->model->comments()->whereNull('parent_id')->count();

        return new LengthAwarePaginator(
            $comments,
            $totalPage,
            $perPage,
            $page,
            ['path' => $path, 'query' => $query]
        );
    }
}
