<x-mail::message>
    O seguinte comentário foi reportardo: {{ $comentario }} no post: {{ $post }}.

    Segue o link do post

<x-mail::button :url="$url">
    Acessar
</x-mail::button>

</x-mail::message>
