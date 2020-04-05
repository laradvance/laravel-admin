<tr>
    <td style="padding-left: 20px" width="{{$width['label']}}%"><strong>{{ $label }}:</strong></td>
    <td width="{{$width['field']}}%">
        <span>
            @if($escape)
                {{ $content }}
            @else
                {!! $content !!}
            @endif
        </span>
    <td>
</tr>