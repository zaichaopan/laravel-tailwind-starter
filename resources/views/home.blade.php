@extends('layouts.app')
@section('title', 'Home')
@section('content')
{{-- <div class="p-4 md:px-0">
    <base-dropdown>
        <div slot="dropdown-trigger">
            Home
        </div>
        <div slot="dropdown-menu">
            <a href="#" class="dropdown-item hover:bg-blue whitespace-no-wrap">Action</a>
            <a href="#" class="dropdown-item hover:bg-blue whitespace-no-wrap">Another action</a>
            <a href="#" class="dropdown-item hover:bg-blue whitespace-no-wrap">Something else here</a>
        </div>
    </base-dropdown>

    <div class="my-2">
        <h2>Share the link</h2>
        <share-link to="twitter" :params="{text: 'Replace this with your text', hashtags: 'hashtag1,hashtag2'}">

        </share-link>

        <share-link to="facebook"></share-link>
    </div> --}}

    @include('sample.table')

    @include('sample.plan')

    @include('sample.newsletter')

    @include('sample.radio')

    {{--
    <div class="my-2">
        <h2>Drop images</h2>
        <multi-image-uploader upload-endpoint="{{ route('images.tmp.store') }}" delete-endpoint="{{ route('images.tmp.destroy')}}"
            file-name="image">
        </multi-image-uploader>
    </div> --}} {{--
    <div class="my-6">

    </div> --}} {{--
    <div class="my-2">
        <h2>Tooltips</h2>

        <span v-tooltip:bottom="'Here is another way to make a tooltip.'"> Tooltip on bottom </span>

        <span data-tooltip-name="profile">
                                Html tooltip
                            </span>.
        <base-tooltip name="profile">
            <div class="p-2">
                <img src="https://placeimg.com/120/120/any" alt="">
                <p>Hello world</p>
            </div>
        </base-tooltip>
    </div> --}} {{--
    <div class="my-2">
        <h2>Share the link</h2>
        <share-link to="twitter" :params="{text: 'Replace this with your text', hashtags: 'hashtag1,hashtag2'}">

        </share-link>

        <share-link to="facebook"></share-link>
    </div>

    <div class="my-2">
        <h2>File input</h2>
        <base-icon :width="30" :height="30" :view-box-width="56" :view-box-height="56">
            <icon-jpg />
        </base-icon>
        <base-icon :width="30" :height="30" :view-box-width="56" :view-box-height="56">
            <icon-txt />
        </base-icon>
        <base-icon :width="30" :height="30" :view-box-width="309.267" :view-box-height="309.267">
            <icon-pdf />
        </base-icon>
        <base-icon :width="30" :height="30" :view-box-width="56" :view-box-height="56">
            <icon-excel />
        </base-icon>
        <base-icon :width="30" :height="30" :view-box-width="56" :view-box-height="56">
            <icon-doc />
        </base-icon>
        <base-icon :width="30" :height="30" :view-box-width="56" :view-box-height="56">
            <icon-png />
        </base-icon>
        <base-icon :width="30" :height="30" :view-box-width="33.293" :view-box-height="33.293">
            <icon-file-uploader />
        </base-icon>

        <div>
            <file-input></file-input>
        </div>
    </div> --}} {{--
    <div class="my-8">
        <base-carousel :total-items="5" :desktop-per-page="4">
            <div class="p-2">
                <img src="https://placeimg.com/640/480/any" class="rounded">
            </div>
            <div class="p-2">
                <img src="https://placeimg.com/640/480/nature" class="rounded">
            </div>
            <div class="p-2">
                <img src="https://placeimg.com/640/480/animals" class="rounded">
            </div>
            <div class="p-2">
                <img src="https://placeimg.com/640/480/people" class="rounded">
            </div>
            <div class="p-2">
                <img src="https://placeimg.com/640/480/tech" class="rounded">
            </div>
        </base-carousel>
    </div> --}}

</div>
{{-- <div class="p-4 md:px-0">
    <base-tab></base-tab>
</div>

<div class="p-4 md:px-0">
    <base-collapse title-key="question" content-key="answer" :item="{{json_encode($question)}}"></base-collapse>
</div> --}}
@endsection
