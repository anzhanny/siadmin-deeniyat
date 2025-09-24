@props(['url'])

<tr>
<td class="header">
    <a href="{{ $url }}" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
        @if (trim($slot) === 'Laravel')
            {{-- Logo Deeniyat + Nama --}}
            <img src="{{ asset('public/assets/img/logos/deeniyat-logo.png') }}" class="logo" 
                 alt="Deeniyat Al Hidayah" style="height: 60px;">
            
            <span style="font-size: 18px; font-weight: bold; color: #2d3748;">
                Deeniyat Al Hidayah
            </span>
        @else
            {!! $slot !!}
        @endif
    </a>
</td>
</tr>
