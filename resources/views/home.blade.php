@extends('layouts.app', ['title' => 'Home'])
@section('app.content')
<div>
    <div class="my-2">
        <h2>Drop images</h2>
        <multi-image-uploader upload-endpoint="{{ route('images.tmp.store') }}" delete-endpoint="{{ route('images.tmp.destroy')}}"
            file-name="image">
        </multi-image-uploader>
    </div>

    <div class="my-6">
        <base-dropdown>
            <button type="button" slot="link" href="#" class="p-2 border border-grey-light no-underline">
                dropdown
                <base-icon icon-name="caret"
                            :width="12"
                            :height="12">
                    <icon-caret />
                </base-icon>
            </button>

            <div slot="dropdown" class="border border-grey bg-white mt-2 w-32">
                <a href="#" class="no-underline block px-4 py-4 border-b text-sm text-grey-darker hover:bg-grey-lightest whitespace-no-wrap">Action</a>
                <a href="#" class="flex items-center no-underline block text-sm px-1 py-4 border-b text-grey-darker hover:bg-grey-lightest whitespace-no-wrap">
                                            <span> Setting</span>
                                        </a>
                <a href="/logout" @click.prevent="logout" class="flex items-center no-underline text-sm block px-4 py-4 border-b text-grey-darker hover:bg-grey-lightest whitespace-no-wrap">
                                            <span>Logout</span>
                                        </a>
            </div>
        </base-dropdown>
    </div>

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
    </div>

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
    </div>

</div>
@endsection
