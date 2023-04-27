<x-mail::message>
    O seguinte comentário foi reportardo: {{ $comentario }} no meme: {{ $meme }}.

    Segue o link do meme

<x-mail::button :url="$url">
    Acessar
</x-mail::button>

</x-mail::message>
