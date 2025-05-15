@extends('layouts.app')

@section('content')
<div class="bg-white px-6 py-32 lg:px-8">
    <div class="mx-auto max-w-3xl text-base/7 text-gray-700">
      <h1 class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">{{ $post->title }}</h1>
      <p class="mt-6 text-xl/8">{{ $post->description }}</p>
      <img class="aspect-video rounded-xl bg-gray-50 object-cover mt-10" src="{{ $post->image }}" alt="{{ $post->title }}">
      <div class="mt-16 max-w-2xl">
        <p class="mt-6">{{ $post->body }}</p>
      </div>
      <div class="mt-16 font-bold">
        <a href="">{{ $post->author->name }}</a>
      </div>
    </div>
    <section id="comments" class="mt-16 flex flex-col items-center gap-15">
      <h2 class="justify-center flex mt-20">
          <a href="{{route('comments.index')}}" class="font-semibold text-xl">Comments</a>
      </h2>
      @if($post->comments->count())
      <div class="flex flex-wrap w-1/2 gap-4 justify-center">
        @foreach($post->comments as $comment)
          <div class="border border-gray-200 p-6 w-1/4">
            <div class ="text-xl"> {{$comment->body }}</div>
            <div class="pt-4 text-sm text-gray-600">
              {{$comment->name}}, {{$comment->created_at->diffForHumans()}}
            </div>
            <form action="{{route('comment.delete', $comment->id)}}" method="POST" class="pt-8 flex justify-end w-full">
              @csrf
              @method('DELETE')
              <button class=" border border-gray-200 px-4 py-1 cursor-pointer hover:bg-gray-100 text-red-600" type="submit" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
            </form>
          </div>
          @endforeach
      </div>
      @else
          <p class="font-light">Post has not been commented yet</p>
      @endif
      <form id="comment-form" method="POST" action="{{route('comment')}}" class="border border-gray-200 p-6 w-1/2">
        @csrf
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <p class="font-semibold text-xl">Leave a comment</p>
        <div class="mt-10">
          <input class="focus:outline-none" type="text" name="name" placeholder="Your name" id="name" required>
        </div>
        <div class="mt-6">
          <textarea class="focus:outline-none" name="body" placeholder="Your comment" id="body" required></textarea>
        </div>
        <div class="mt-6">
          <button class="border border-gray-200 px-4 py-1 cursor-pointer hover:bg-gray-100" type="submit">Submit</button>
        </div>
      </form>
    </section>
  </div>
@endsection
