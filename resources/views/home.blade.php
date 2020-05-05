@extends('layouts.app')

@section('style')
    <style>
        .col-12{
            margin:10px 0;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        @auth
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('post.store') }}" method="POST">
                        @csrf
                        <div class="card-header">Criar nova postagem</div>
                        <div class="card-body">
                        @if($errors->any())
                            <ul class="alert">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                            <label for="content">Postagem</label>
                            <textarea name="content" id="content" rows="10" cols="80" ></textarea>
                        </div>
                        <div class="card-footer d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        @endauth
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">Título da postagem</div>
                <div class="card-body">
                    <h5>Autor: <small>Nome do usuario</small></h5>
                    <p>
                        Texto com o conteúdo da postagem<br>
                        Mussum Ipsum, cacilds vidis litro abertis. 
                        Si num tem leite então bota uma pinga aí cumpadi! 
                        Mais vale um bebadis conhecidiss, que um alcoolatra anonimis. 
                        Atirei o pau no gatis, per gatis num morreus. 
                        Mé faiz elementum girarzis, nisi eros vermeio. 
                    </p>
                    <hr>
                    <a href="#comentarios-abc" data-toggle="collapse" aria-expanded="false" aria-controls="comentarios-abc">
                        <small>
                            comentários (2)
                        </small>
                    </a>
                    <div class="my-2 comentarios collapse" id="comentarios-abc">
                        @comentario(["autor"=>"João lindão"])
                            Mussum Ipsum, cacilds vidis litro abertis. Posuere libero varius.
                            Nullam a nisl ut ante blandit hendrerit. Aenean sit amet nisi.
                            Aenean aliquam molestie leo, vitae iaculis nisl. Atirei o pau no gatis, per gatis num morreus.
                            Si u mundo tá muito paradis? 
                            Toma um mé que o mundo vai girarzis! 
                        @endcomentario
                        @comentario(['autor'=>'Mussum cacildis'])
                            Mussum Ipsum, cacilds vidis litro abertis. 
                            Per aumento de cachacis, eu reclamis. 
                            Não sou faixa preta cumpadi, sou preto inteiris, inteiris. Praesent vel viverra nisi. 
                            Mauris aliquet nunc non turpis scelerisque, eget. 
                            Si num tem leite então bota uma pinga aí cumpadi!  
                        @endcomentario
                    </div>
                    @auth
                        <hr>
                        <div>
                            <form action="{{ route('comentario.store',1) }}" method="POST">
                                @csrf
                                <input type="hidden" name="postagem" value="1">
                                <div class="form-group">
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
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">Título da postagem</div>

                <div class="card-body">
                    <p>
                        Texto com o conteúdo da postagem<br>
                        Mussum Ipsum, cacilds vidis litro abertis. Em pé sem cair, deitado sem dormir, sentado sem cochilar e fazendo pose. Mé faiz elementum girarzis, nisi eros vermeio. Copo furadis é disculpa de bebadis, arcu quam euismod magna. Mauris nec dolor in eros commodo tempor. Aenean aliquam molestie leo, vitae iaculis nisl. 
                    </p>
                    <hr>
                    <a href="#comentarios-bcd" data-toggle="collapse" aria-expanded="false" aria-controls="comentarios-bcd">
                        <small>
                            comentários (2)
                        </small>
                    </a>
                    <div class="my-2 comentarios collapse" id="comentarios-bcd">
                        @comentario(['autor'=>"Eu mesmo"])
                            Mussum Ipsum, cacilds vidis litro abertis. 
                            Cevadis im ampola pa arma uma pindureta. Per aumento de cachacis, eu reclamis. 
                            Posuere libero varius. Nullam a nisl ut ante blandit hendrerit. Aenean sit amet nisi. 
                            Mauris nec dolor in eros commodo tempor. 
                            Aenean aliquam molestie leo, vitae iaculis nisl. 
                        @endcomentario
                        @comentario(['autor'=>"Outra pessoa"])
                            Mussum Ipsum, cacilds vidis litro abertis. 
                            Per aumento de cachacis, eu reclamis. 
                            Não sou faixa preta cumpadi, sou preto inteiris, inteiris. Praesent vel viverra nisi. 
                            Mauris aliquet nunc non turpis scelerisque, eget. 
                            Si num tem leite então bota uma pinga aí cumpadi!
                        @endcomentario
                    </div>
                    @auth
                        <hr>
                        <div>
                            <form action="{{ route('comentario.store',1) }}" method="POST">
                                @csrf
                                <input type="hidden" name="postagem" value="1">
                                <div class="form-group">
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


        @foreach($posts ?? '' as $post)
            <div class="col-md-6 col-12">
                <div class="card">
                    <div style="display: flex;justify-content: space-between;" class="card-header">Titulo da postagem
                    @if(auth()->user())
                        @if($post->name == auth()->user()->name)
                            <form method="POST" action="{{ route('post.destroy', [$post->id]) }}">
                                @csrf
                                @method("DELETE")
                                <button style="background-color:red" type="submit">Delete</button>
                            </form>
                        @endif
                    @endif
                    </div>
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
                                        <label for="comment">Comentario</label>
                                        <textarea name="comment" id="comment" class="form-control"></textarea>
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

@section('script')
    <script>
        window.onload = function(){ 
            CKEDITOR.replace('content')
            CKEDITOR.config.height = 100;
        }
    </script>
@endsection
