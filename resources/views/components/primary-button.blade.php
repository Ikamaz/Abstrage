<style>
    @font-face {
        font-family: 'BPG';
        src: url('../../../public/bpg_nino_mtavruli_bold.ttf') format('truetype');
    }


    button {
        margin-right: 5px;
        margin-top: 5px;
        font-family: 'BPG';
        letter-spacing: 0.4px;
    }
</style>
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
