# Common Features

## React

like

category: like, readinglist (book mark), unicorn

- user_id (index)
- categroy: string (index)
- reactable_id (index)
- reactable)type (index)
- flat: points, default: 1.0
- timestamps

```php
class ReactionsController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $reactionCount = $request->has('article_id')
            ? Reaction::countForArticle($request->article_id)
            : Reaction::countForCommon($request->commentable_id);

    }


    public function store(Request $request)
    {
        $params = [
           'user_id' => $request->user_id,
           'reactable_id' => $request->reactable_id,
           'reactable_type' => $request->reactable_type,
           'category' => $request->category?? 'like',
       ];

       $reaction = Reaction::where($params)->first();

       if ($reaction) {
           $reaction->user()->touch():
           $reaction->destroy();
           $result = "destroy";
       } else {
           $reaction = Reaction::create($params);
           $result = "create";
       }

       return response()->json([
           'result' => $request,
           'category' => $request->category ?? 'like'
       ]);
    }
}
```

$: the end of line (select until the end of delete v$, delete: d$)

## Reference


## follow

- blocked_at,
- followable_id
- followable_type
- follower_id
- follower_type
- timestamps


```php

```


```php
class Follow
{
    use FollowScopes;

    public function followerable()
    {
        return $this->morphTo();
    }
    public function follower()
    {
        return $this->morphTo();
    }

    public function scopeBlock($query)
    {
        return $query->where('block', true);
    }
}
```

```php
function getShortClassName($obj)
{
    $classInfo = new \ReflectionClass($obj);
    return $classInfo->getShortName():
}
```

```php
trait FollowScopes
{
     # returns Follow records where follower is the record passed in.
    public function scopeForFollower($query, $follower)
    {
        return $query->where([
            'follow_id' => $follower->id,
            'follow_type' => getShortClassName($follower)
            ]);
    }

    # returns Follow records where followable is the record passed in.
    public function scopeForFollowable($query, $followable)
    {
        return $query->where([
            'followable_id' => $followable->id,
            'followable_type' => getShortClassName($followable)
        ]);
    }

    # returns Follow records where follower_type is the record passed in.
    public function scopeForFollowerType($query, $followerType)
    {
        return $query->where('follower_type', $followerType);
    }

    # returns Follow records where followeable_type is the record passed in.
    public function scopeForFollowableType($query, $followableType)
    {
        return $query->where('followable_type', $followableType);
    }

    # returns Follow records from past 2 weeks with default parameter.
    public function scopeRecentFrom($query, $from)
    {
        return $query->where('created_at', '>', $from ?? now()->subWeeks(2));
    }

    # returns unblocked Follow records.
    public function scopeUnblocked($query)
    {
        return $query->where('blocked', false);
    }

    # returns blocked Follow records.
    public function scopeBlocked($query)
    {
        return $query->where('blocked', true);
    }

}

```

// ActAsFollower

```php
trait ActAsFollower
{
    protected static function bootActAsFollower()
    {
        static::deleting(function($model) {
            $model->follows->each->delete();
        });
    }


    // the flowerables that the insance if following
    public function follows()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    # Returns true if this instance is following the object passed as an argument.
    public function following($followable)
    {
        return $this->fllows()->unbocked()->forFollowable($followable)->count() > 0;
    }

    # Returns the number of objects this instance is following.
    public function followsCount()
    {
        return $this->follows()->unblocked()->count();
    }

    # Creates a new follow record for this instance to follow the passed object.
    # Does not allow duplicate records to be created.
    public function follow($followable)
    {
        if ($this!== $followable) {
            $params = [
                'followable_id' =>$followable->id,
                'followable_type' => parent_class_name($followable)
            ];

            $this->follows()->where($params)->firstOrCreate();
        }
    }


    # Deletes the follow record if it exists.
    public function stopFollowing($followable)
    {
        optional($follow = $this->getFollow($followable))->destroy();
    }

    # returns the follows records to the current instance
    public function followsScoped()
    {
        return $this->follows()->unblocked()->with('followable');
    }

    # Returns the follow records related to this instance by type.
    public function followByType($followableType, $options = [])
    {
        $followsScope = $this->followsScoped()->forFollowableType($followableType);
        $followsScope = applyOptionsToScope($followsScope, $options);
        return $followsScope;
    }

      # Returns the follow records related to this instance with the followable included.
      public function allFollows($options = [])
      {
          $followsScope = $this->followsScoped();
          $followsScope = applyOptionsToScope($followsScope, $options);
          return $followsScope;
      }

      # Returns the actual records which this instance is following.
      public function allFollowing($options = [])
      {
          return $this->allowFollows($options)->map(function($follow) {
              return $follow->followable;
          });
      }


      # Returns a follow record for the current instance and followable object.
      public function getFollow($followable)
      {
          return $this->follows()->unblocked()->forFollowable($followable)->first();
      }
}

```

```php
trait ActionAsFollowable
{
    protected static function bootFollowable()
    {
        static::deleting(function ($model) {
            $model->followings->each->delete();
        });
    }

    public function followings()
    {
        return $this->morphs(Follow::class,'followable');
    }

     # Returns the number of followers a record has.
     public function followersCount()
     {
         return $this->followings()->unblocked()->count();
     }

     # Returns the followers by a given type
     public function followersByType($followType, $options = [])
     {
         return $this->followings()->unblocked()->where([ 'follower_type' => $followerType; ]);

     }

     public function followersByTypeCount($followerType)
     {
         return $this->followings()->unblocked()->forFollowerType($followerType)->count();
     }

}

```

```php
class User
{
    use ActAsFollower, AsAsFollowable;


}

$jane->follow($john);
$jane->following($john);
$jane->follows();
$jane->followers();

// get MutualFollowers
// get followers
// get follows

```

```php
class Orders
{
    public $currentStep;

    public $steps = ['shipping', 'billing', 'confirmation'];

    public function currentStep()
    {
        return $currentStep ?? $steps[0];
    }

    public function nextStep()
    {
        $this->currentStep = $this->steps[array_search($this->currentStep(), $this->steps) +1);
    }

    public function previousStep()
    {
        $this->currentStep = $this->steps[array_search($this->currentStep(), $this->steps) -1);
    }

    public function isFirstStep()
    {
        return $this->currentStep() === $this->steps[0];
    }

    public function isLastStep()
    {
        return $this->currentStep() === $this->steps[count($this->steps)-1];
    }
}

class OrdersController
{
    public function create()
    {
        $order  = Order::create(session('orderParams', []));
        $order->currentStep = session('orderStep');
        return view('orders.create', ['order' => $order]);
    }

    public function store(Request $request)
    {
        //valid base on step
        $orderParams = array_merge(
            session('order_params'),
            array_only($order->currentStep() . 'AllowedParams',  $request->all()
        );

        $order = Order::create($orderParams);
        $order->currentStep  = session('order_step');


        if ($request->has('back_button')) {
            $order->previousStep();
        }elseif ($order->isLastStep()) {
           // do all validation and sav
        }else {
            $order->nextStep();
        }

        session('order_step') = $order->currentStep();

        // has not created
        if ($order->new) {
            return redirect('back');
        }

        // $order has been created
        session('orderParams') = null;
        session('currentStep' ) = null;
        return view('orders.show', ['order' => $order]);
    }
}
```

```html
<form method="POST" action="{{ route('orders.store')}}">
    @csrf
    @include("order.partials". $order->currentStep() . '_step');

    @if (!$order->isFirstStep())
        <button name="back_button" type="submit">Back</button>
    @endif
    <button type='submit'>Continue</button>
</form>
```

## Nested Comments

```php
class PostsController extends Controller
{

    public function index()
    {
        return view('posts.index', ['posts' => Post::paginate()]);
    }

    public function show(Post $post, Request $request)
    {
        $comments = $request->has('comment')
            ? $post->comments()->where('id', $request->comment)
            : $post->comments()->whereNull('parent_id');

        $comments = $comments->paginate(5);

        return view('posts.show', ['post' => $post, 'comments' => $comments]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //
    }
}
```

```php
class Comment
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
```

```php
abstract class CommentsController extends Controller
{
    public function create(CommentableInterface $commentableInterface, Request $request)
    {
        $comment= new Comment($request->all());
        $commentableInterface->comments()->save($comment);
    }

    public function delete()
    {
    }

    abstract protected function commentable(Request $request);
}
```

```php
class PostCommentsController extends CommentsController
{
    public function($request)
}
```

Use Bin Scripts to onboard process

```sh
#!/bin/bash
# Sample bin/init.sh

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
```

```sh
#!/bin/bash
# Sample bin/update.sh

composer install
php artisan migrate
npm install
npm run dev
```

## Service Classes

Catchall for "POPO (Plain Old PHP Object)" that does stuff without being specifically tied to a design pattern or framework structure.

Get creative with your naming (e.g. __RetrieveMoviePoster__)

Consider __invoke(): RetrieveMoviePoster()

Benefits

- Shorter methods
- "Separation of Concerns"
- Easier and clearer and more obvious testing
- You get to say "POPO" more

## Customer Requests

```php
class SignUpRequest extends Request
{
    public function prepared()
    {
        // Do stuff here with the data
    }
}
```

```php
// In controller
public function store(SignUpRequest $request)
{
    $data = $request->prepared();
    // ... etc.
}
```

Benefits

- Small controllers
- Easier testing
- Separate repetitive input logic (e.g. preparing data)

## View Data Composition

- Presenter
- View Model
- Responsable

```php
class PostPresenter
{
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function presentPublishedAt()
    {
        return $this->published_at->format('M j, Y');
    }

    // Use customer, * or* use a presenter package to get magic
    // Eloquent-style accessors
}
```

```php
// In controller
return view('posts.show')->with('post', new PostPresenter($post));
```

## View Models

```php
class DashboardViewModel
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function topTasks()
    {
        $overdue = $this->overdueTasks();
        return array_merge($overdue, $this->fillTasksDueSoon(count($overdue)));
    }

    public function progressChart()
    {
        return [
            'percentage_complete' => $this->progressPercentageComplete(),
            'date_markers' => $this->dateMarkers()
        ];
    }
}
```

```php
// In use:
return view('dashboard')->view('vm', new DashboardViewModel($user));
```

## Responsables

```php
class DashboardViewResponse implements Responsable
{
    public function prepareData()
    {
        return [
            'tasks' => $This->tasks, // etc.
        ];
    }

    public function toResponse()
    {
        $data = $this->prepareData();

        if (request()->ajax()) {
            return response()->json($data);
        }

        return response()->view('dashboard', $data);
    }
}
```

```php
// In use (in the controller)
return new DashboardViewResponse($user);
```
