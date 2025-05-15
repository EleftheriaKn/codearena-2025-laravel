@extends('layouts.app')

@section('content')
    <h2 class="justify-center flex mt-20">
        <a href="{{route('comments.index')}}" class="font-semibold text-xl">Comments</a>
    </h2>
    <section id="comments" class="mt-16 flex flex-col items-center gap-15">
      @if($comments->count())
      <div class="flex flex-wrap w-full gap-4 justify-center">
        @foreach($comments as $comment)
          <div class="border border-gray-200 p-6 w-1/8">
            <div class ="text-xl"> {{$comment->body }}</div>
            <div class="pt-4 text-sm text-gray-600">
              {{$comment->name}}, {{$comment->created_at->diffForHumans()}}
            </div>
            <div class="pt-4 text-xs text-gray-600 font-light">
                {{$comment->post->title}}
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
          <p>Post has not been commented yet</p>
      @endif
@endsection