@extends('one-theme::layouts.master')

@section('content')
    <div class="bg-white">
        <div>
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-8">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                        {{ $post->title }}
                    </h1>
                </div>

                <div class="pt-6">
                    @if($post->category)
                        @include('one-theme::sections.breadcrumb', ['links' => [
                            [
                                "label" => __('Blog'),
                                "url" => url('/blog')
                            ],
                            [
                                "label" => $post->category?->name,
                                "url" => url('/blog?categories[]=' . $post->category?->id)
                            ],
                            [
                                "label" => $post->title,
                                "url" => url('/blog/' . $post->slug)
                            ]
                        ]])
                    @else
                        @include('one-theme::sections.breadcrumb', ['links' => [
                        [
                            "label" => __('Blog'),
                            "url" => url('/blog')
                        ],
                        [
                            "label" => $post->title,
                            "url" => url('/blog/' . $post->slug)
                        ]
                    ]])
                    @endif
                </div>

                <div class="font-main">
                    <div class="bg-cover bg-center w-60 h-60 mx-auto my-4" style="background-image: url('{{ $post->getFirstMediaUrl('feature') }}')">

                    </div>

                    <x-tomato-markdown-viewer :content="$post->body" />

                    @if(count($ref))
                        <br />
                        <hr />
                        <br />
                        <h1 class=" text-3xl text-center text-main font-bold">{{__('Related Posts')}}</h1>
                        <div class="grid grid-cols-1 gap-4 px-8 py-8 mt-8 lg:gap-8 sm:grid-cols-3 lg:grid-cols-4 font-main">
                            @foreach ($ref as $refPost)
                                @include('one-theme::blog.parts.blog-card')
                            @endforeach
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
@endsection
