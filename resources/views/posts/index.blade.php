@extends('layouts.app')

@section('content')

    <!-- Verifica se existem músicas cadastradas -->
    <div class="card">
        <h2>Criar Novo Post</h2>
    
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
    
            <div class="form-group">
                <label for="conteudo">O que você está pensando?</label>
                <textarea name="conteudo" id="conteudo" rows="5" placeholder="Escreva seu post aqui..." required>{{ old('conteudo') }}</textarea>
                
                @error('conteudo')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
    
            <button type="submit">Publicar Post</button>
            <a href="{{ route('posts.index') }}" class="btn-cancelar">Cancelar</a>
        </form>
    </div>

    @if ($posts->isEmpty())
        <div style="background-color: var(--card-bg); border: 1px solid var(--border-color); padding: 40px; text-align: center; border-radius: 12px; margin-top: 20px;">
            <div style="font-size: 3rem; margin-bottom: 15px;">🎵</div>
            <h2>Nenhuma post por aqui...</h2>
        </div>
    @else
        <!-- Lista Geral de Músicas -->
        <div class="songs-list">
            @foreach ($posts as $index => $post)
                <div class="song-item">
                    <div class="song-details">
                        <span class="song-index">{{ $index + 1 }}</span>
                        <div>
                            <!-- Título da música -->
                            <span class="song-title">{{ $post->conteudo }}</span>
                            <div class="song-album-info">
                                Autor: 
                                @if ($post->user)
                                    <!-- Link para ir aos detalhes do álbum -->
                                    {{ $post->user->name }}
                                @else
                                    <span style="color: var(--text-muted);">Sem Álbum</span>
                                @endif

                                @if(auth()->check() && auth()->id() === $post->user_id)
                                    <form action="{{ route('posts.destroy', $post) }}">
                                        @method('delete')
                                        <button type="submit">Deletar</button>
                                    </form>
                                    <a href="{{ route('posts.edit', $post) }}">Editar</a>
                                @endif
                                @forelse ($post->comentarios as $comentario)
                                    
                                @empty
  
                                @endforelse 
                                @else
                                    <span style="color: var(--text-muted);">Sem Álbum</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            @endforeach
        </div>
    @endif
@endsection
