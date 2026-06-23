<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Post</title>
    <style>
        body { font-family: sans-serif; margin: 40px; background: #f4f4f4; }
        .card { background: white; padding: 20px; border-radius: 8px; max-width: 500px; margin: auto; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { background: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; font-size: 0.85em; margin-top: 5px; }
        .btn-cancelar { color: #666; text-decoration: none; margin-left: 10px; font-size: 0.9em; }
    </style>
</head>
<body>

<div class="card">
    <h2>Editar Post</h2>

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        
        @method('PUT')

        <div class="form-group">
            <label for="conteudo">Conteúdo do Post:</label>
            <textarea name="conteudo" id="conteudo" rows="5" required>{{ old('conteudo', $post->conteudo) }}</textarea>
            
            @error('conteudo')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Salvar Alterações</button>
        <a href="{{ route('posts.index') }}" class="btn-cancelar">Cancelar</a>
    </form>
</div>

</body>
</html>