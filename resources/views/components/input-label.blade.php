@props(['value'])
<style>
    @font-face {
        font-family: 'BPG';
        src: url('../../../public/bpg_nino_mtavruli_bold.ttf') format('truetype');
    }


    label{
        margin-top: 5px;
        font-family: 'BPG';
        letter-spacing: 0.4px;
    }
</style>

<label {{ $attributes->merge(['class' => 'block font-semibold text-md mb-2']) }}>
    {{ $value ?? $slot }}
</label>
