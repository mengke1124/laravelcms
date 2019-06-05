@php
    $editor = config('administrator.editor', 'simditor');
@endphp

@if( 'simditor' == $editor )
<link rel="stylesheet" type="text/css" href="{{ asset('cms/plugins/editor/css/simditor.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('cms/plugins/editor/css/simditor-html.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('cms/plugins/editor/css/simditor-markdown.css') }}">
@elseif('ueditor' == $editor)

@endif
