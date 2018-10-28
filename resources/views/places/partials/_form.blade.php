<form method="post" action="{{$action}}">
    @csrf
    <textarea name="body" class="w-full border border-grey rounded" cols="30" rows="5"></textarea>

    

    @isset($parent_id)
        <input name="parent_id" value="{{$parent_id}}" hidden>
    @endisset

    <button class="shadow bg-purple hover:bg-purple-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
        type="submit">
            post
        </button>
</form>
