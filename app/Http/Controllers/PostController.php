<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Musica;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Exibe a listagem de todas as músicas.
     */
    public function index()
    {
        // Eloquent: Busca todas as músicas carregando os dados do álbum correspondente (belongsTo)
        $posts = Post::with('user')->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Salva o novo post no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados recebidos do formulário
        $request->validate([
            'conteudo' => 'required|string|max:1000',
        ], [
            // Mensagens personalizadas (opcional)
            'conteudo.required' => 'O campo conteúdo é obrigatório.',
            'conteudo.max' => 'O post não pode ter mais de 1000 caracteres.',
        ]);

        // 2. Criação do post associado ao usuário autenticado
        Post::create([
            'user_id'  => auth()->id(), // Pega o ID do usuário logado
            'conteudo' => $request->conteudo,
        ]);

        // 3. Redireciona para a listagem com uma mensagem de sucesso
        return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
    }

 
    public function edit(Post $post)
    {
        $post = Post::findOrFail($post->id);
        if ($post->user_id != auth()->id()) {
            return redirect()->route('posts.index')->with('error','Não foi possível realizar a operação');
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Atualiza o post no banco de dados.
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id != auth()->id()) {
            return redirect()->route('posts.index')->with('error','Não foi possível realizar a operação');
        }

        // Validação dos dados recebidos
        $request->validate([
            'conteudo' => 'required|string|max:1000',
        ]);

        // Atualiza apenas o campo conteúdo
        $post->update([
            'conteudo' => $request->conteudo,
        ]);

        // Redireciona de volta para a listagem com uma mensagem de sucesso
        return redirect()->route('posts.index')->with('success', 'Post atualizado com sucesso!');
    }

    public function destroy(Request $request, Post $post)
    {
        if ($post->user_id != auth()->id()) {
            return redirect()->route('posts.index')->with('error','Não foi possível realizar a operação');
        }

        $post->delete();

        // Redireciona de volta para a listagem com uma mensagem de sucesso
        return redirect()->route('posts.index')->with('success', 'Post deletado com sucesso!');
    }

}
