@props([
    'id',
    'titulo' => '',
    'aoGuardar',
    'botao' => 'Guardar',
    'cancelar' => 'Cancelar',
])

<dialog id="{{ $id }}">
    <form onsubmit="{{ $aoGuardar }}">
        <div class="popup-titulo" id="{{ $id }}Titulo">{{ $titulo }}</div>

        {{ $slot }}

        <div class="popup-botoes" style="margin-top: 20px;">
            <button type="button" onclick="fechar('{{ $id }}')">{{ $cancelar }}</button>
            <button type="submit">{{ $botao }}</button>
        </div>
    </form>
</dialog>
