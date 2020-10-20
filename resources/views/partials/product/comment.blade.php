<div class="card card-outline-secondary my-4">
    <div class="card-body">
        <span class="font-weight-bold mb-2">{{$comment->title}}</span><br>
        @for($i = 1; $i < 6; $i++)
            @if($comment->rate >= $i)
                <i class="fas fa-star text-warning"></i>
            @else
                <i class="far fa-star"></i>
            @endif
        @endfor
        <p class="pt-2">{{$comment->content}}</p>
        <small class="text-muted">Posté par {{$comment->user->name}} le {{$comment->created_at}}</small>
    </div>
</div>
