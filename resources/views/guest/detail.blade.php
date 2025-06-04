@php
    preg_match('/<(p|div)[^>]*>(.*?)<\/\1>/is', $data->article, $matches);
    $firstBlock = $matches[2] ?? $data->article;

    $cleanText = strip_tags($firstBlock);

    // Hapus &nbsp; dan decode entity lain seperti &amp;, &quot;, dll
    $cleanText = str_replace('&nbsp;', ' ', $cleanText);
    $cleanText = html_entity_decode($cleanText, ENT_QUOTES | ENT_HTML5);

    $sentence = Str::limit(trim($cleanText), 155);
@endphp
<x-layout.guest :title="$data->judul. ' - '.json_decode(\Storage::get('website.json'), true)['title']" :desc="$sentence" :tags="$data->articles->articletag" :footer="false">
    <div class=" background w-full">
        {{-- Header --}}
        @include('components.guest.header.'.$template->head_type)
        <div class=" w-full pt-4 px-4 sm:pt-6 sm:px-6 pb-2 space-y-4 sm:space-y-6">
            @if ($data->articleshowgallery->isNotEmpty())
                {{-- Gallery --}}
                @include('components.guest.gallery.'. $template->gallery_type)
            @endif
            {{-- Description --}}
            <x-guest.description :template="$template" :data="$data"/>
            {{-- Video --}}
            @if ($data->articles->video_type != 'none')  
                @include('components.guest.'.$data->articles->video_type)
            @endif
        </div>
        {{-- Contact --}}
        @include('components.guest.contact.one')
    </div>
    <style>
        .background {
            @if ($template->bg_type === 'normal')
                background-color: {{ $template->bg_main_color }};
            @elseif ($template->bg_type === 'gradient')
                background: linear-gradient(to bottom, {{ $template->bg_main_color }}, {{ $template->bg_second_color }});
            @elseif ($template->bg_type === 'image')
                background-image: url('{{ asset('storage/images/template/background/'.$template->bg_image) }}');
                background-size: cover;
                background-position: center;
            @endif
        };
    </style>
</x-layout.guest>