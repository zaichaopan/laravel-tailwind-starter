# Todo

Check a better way to assert session error message

```php
$this->assertEquals('The given latitude is not valid', session('errors')->first('lat'));
```

check a better way to assert a error field exists

```php
   $this->post(route('places.store'), $this->validParams());
        $this->assertFalse(session('errors')->has('lat'));
```

To test post data

```php
  protected function validParams($overrides = [])
    {
        return factory('App\Place')->make(array_merge([
            'user_id' => null
        ], $overrides))->toArray();
    }
```

```php
$this->assertSessionHasNoErrors();
//assert a error not existing
```

```php
  $this->assertArraySubset([
            'title' => '...',
            'published_at' => '...',
            'word_count' => '...'
        ], $post->toArray());


         $this->assertArraySubset(
            array_only($validParams, ['address', 'lat', 'lng', 'description']),
            $places->first()->toArray()
        );
        ```


```php
 //'images.*.src' => 'nullable|string'
 'images' => 'nullable|array|min:1', // can be null, but must be an array with at least 1 item if exists
 ```


```php
$article = Article::find(1);

$comments = $article->buildNestedComments();

```

```php
trait  HasNestedComments
{
    public function nestedComments($page, $perPage)
    {
        $comments = $this->comments();
        $groupedComments = $comments->groupBy('parent_id');
        $rootComments = $groupedComments->get(null)->forPage($page, $perPage);
        $ids = $this->getNestedIds($root, $groupedComments);
        $returnedComments = $comments->whereIn('id', $ids)->with(['user', 'parent.user'])->get()->group('parent_id');
        $returnedRootComments = $returnComments->get();
        return $this->buildNest($returnedRootComments, $returnedComments);
    }

    public function buildNestedIds($rootComments, $groupedComments, &$ids=[])
    {
        foreach($rootComments as $rootComment) {
            $ids[] = $rootComment->id
            $rootCommentReplies = $groupedComments->get($rootComment->id);
            if (count($rootCommentReplies)) {
                $this->buildNestedIds($rootCommentReplies, $groupedComments, $ids);
            }
        }

        return $ids;
    }

    public function buildNest($rootComments, $allComments)
    {
        return $rootComments->each(function ($rootComment) use ($allComments) {
            if ($replies = $allComments->get($comment->id)) {
                $rootComment->children = $replies;
                $this->build($replies, $allComments);
            }
        });
    }
}
```
