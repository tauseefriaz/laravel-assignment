<ul class="comments" id="comment-{{ $comment->id }}" comment-id="{{ $comment->id }}">
    @php $count++ @endphp
    <li class="clearfix">
        <img src="https://bootdey.com/img/Content/user_{{ rand(1,3) }}.jpg" class="avatar" alt="">
        <div class="post-comments">
            <p class="meta">{{ $comment->created_at }} <b>{{ $comment->name }}</b> says @if($count<=3)<i class="pull-right reply"><a href="# reply"><small>Reply</small></a></i>@endif</p>
            <p>
              {{ $comment->comment }}
            </p>
        </div>
    </li>
    @if(count($comment->children))
        @foreach($comment->children as $comment)
            @include('includes/comment', ['comment' => $comment])
        @endforeach
    @endif
</ul>