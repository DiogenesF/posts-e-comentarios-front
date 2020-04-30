@extends('layouts.app')

@section('style')
    <style>
        .col-12{
            margin:10px 0;
        }
    </style>
@endsection

@section("content2")
    <div class="container">
        <div class="row">
        @foreach($posts ?? '' as $post)
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">Titulo da postagem</div>
                    <div class="card-body">
                        <h5>Autor: {{$post->name}}</h5>
                        <p>
                            {!! $post->content !!}
                        </p>
                        <hr>
                        <a href="#comentarios-{{$post->id}}" data-toggle="collapse" aria-expanded="false" aria-controls="comentarios-{{$post->id}}">
                            <small>
                                comentários ( {{count($post->comments)}} )
                            </small>
                        </a>
                        @foreach($post->comments as $comment)
                        <div class="my-2 comentarios collapse" id="comentarios-{{$post->id}}">
                        @comentario(['autor'=>$comment->name])
                            {{ $comment->comment }}
                        @endcomentario
                        </div>
                        @endforeach
                        @auth
                            <hr>
                            <div>
                                <form action="{{ route('comentario.store',1) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="postagem" value="{{$post->id}}">
                                    <div class="form-group">
                                    @if($errors->any())
                                        <ul class="alert">
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                        </ul>
                                    @endif
                                        <label for="comentario">Comentario</label>
                                        <textarea name="comentario" id="comentario" class="form-control"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Salvar comentário</button>
                                </form>
                            </div>    
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection