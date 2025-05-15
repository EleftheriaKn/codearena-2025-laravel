<div class="bg-white px-6 py-32 lg:px-8">
    <div class="mx-auto max-w-3xl text-base/7 text-gray-700">
      <div class="mt-16 max-w-2xl">
        <p class="mt-6">{{ $comment->body }}</p>
      </div>
      <div class="mt-16 font-bold">
          <a href="">{{ $comment->name }}</a>
          <p>{{ $comment->created_at->diffForHumans() }}</p>
    </div>
</div>    