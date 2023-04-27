<x-mail::message>
    O seguinte meme foi reportardo: {{ $meme }}.

    Segue o link do meme

<x-mail::button :url="$url">
    Acessar
</x-mail::button>

</x-mail::message>
