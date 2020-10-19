<div class="card card-outline-secondary my-4">
    <div class="card-header">
        Commentaires
    </div>
    @foreach($comments as $comment)
    <div class="card-body">
        <p class="font-weight-bold">{{$comment->title}}</p>
        <p>{{$comment->content}}</p>
        <small class="text-muted">Posté par {{$comment->user->name}} le {{$comment->created_at}}</small>
        <hr>
    </div>
    @endforeach
</div>
