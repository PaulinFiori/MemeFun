<x-mail::message>
    O seguinte post foi reportardo: {{ $post }}.

    Segue o link do post

<x-mail::button :url="$url">
    Acessar
</x-mail::button>

</x-mail::message>
