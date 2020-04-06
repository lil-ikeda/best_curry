@extends('layouts.app')
@include('navbar')
@include('footer')

@section('content')

<div class="col-md-8 col-md-2 mx-auto">
    <div class="card-wrap">
      <div class="card">
        <img src="/storage/post_images/{{ $post->id }}.jpg" class="card-img-top" />
        <!-- 料理名 -->
        <div class="card-middle">
          <div class="post-name">{{ $post->name }}</div>
          <!-- 材料 -->
          <p class="middle-title">材料</p>
          <div id="comment-post-{{ $post->id }}">
            @include('post.material_list')
          </div>

          <div class="modal js_modal">
  <div class="modal__bg js_modal_close">
    <div class="modal__content">
      <h1>3種類の声かけで音声ガイドの操作ができます。</h1>
      <br>
      <p>「次」：ひとつ後の工程に　　　　　　　　</p>
      <br>
      <p>「もう１回」：今の工程のガイドをもう一度</p>
      <br>
      <p>「戻る」：ひとつ前の工程に　　　　　　　</p>
      <br>
      <p class="guide_start">音声ガイドをスタートしますか？</p>
      <div class="yesno_split">
        <div class="js_modal_close btn">やめる</div>
        <div class="js_modal_close" id="btn">スタートする</div>
      </div>
    </div>
  </div>
</div>


          <div class="howto_split">
            <p class="middle-title-howto">作り方</p>
            <button class="js_modal_open">音声ガイドをスタートする</button>
          </div>
          <span>{!! nl2br(e($post->caption)) !!}</span>
        </div>
        <div class="card-body">
          <div class="row parts">
            <div id="like-icon-post-{{ $post->id }}">
                @if ($post->likedBy(Auth::user())->count() > 0)
                  <a class="loved hide-text" data-remote="true" rel="nofollow" data-method="DELETE" href="/likes/{{ $post->likedBy(Auth::user())->firstOrFail()->id }}">いいねを取り消す</a>
                @else
                  <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="/posts/{{ $post->id }}/likes">いいね</a>
                @endif
              </div>
          </div>
          
          <div id="like-text-post-{{ $post->id }}">
            @include('post.like_text')
          </div>
          
          <div class="row actions" id="comment-form-post-{{ $post->id }}">
            <form class="w-100" id="new_comment" action="/posts/{{ $post->id }}/comments" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="✓" />
              {{csrf_field()}} 
                <input value="{{ Auth::user()->id }}" type="hidden" name="user_id" />
                <input value="{{ $post->id }}" type="hidden" name="post_id" />
                <input class="form-control comment-input border-0" placeholder="コメント ..." autocomplete="off" type="text" name="comment" />
              </form>
            </div>

            <hr>

            <div>
            <!-- <span><strong>{{ $post->user->name }}</strong></span> -->
            <div id="comment-post-{{ $post->id }}">
              @include('post.comment_list')
            </div>
            <a class="light-color post-time no-text-decoration" href="/posts/{{ $post->id }}">{{ $post->created_at }}</a>
            
          </div>
        </div>
</div>
</div>
</div>
@endsection