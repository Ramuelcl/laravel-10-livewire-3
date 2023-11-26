@props([
    'imagen' => '',
    'titulo' => 'Olvidaste el título',
    'subtitulo' => 'Olvidaste el subtítulo',
    'contenido' => 'olvidaste el contenido',

    'autor' => 'Ramuel González',
    'fecha' => now(),
])
<article class="flex flex-col bg-white shadow-md rounded-md overflow-hidden max-w-sm">
    <!-- Card -->
    <div class="block dark:bg-neutral-700 text-center h-52">
        <!-- Card image -->
        @if ($imagen)
            <a href="#!">
                <img class="h-full w-full object-cover object-center" src="{{ $imagen }}"
                    alt="{{ $titulo }}" />
            </a>
        @endif
    </div>
    <!-- Card header -->
    <div class="border-b-2 border-neutral-100 px-6 py-4 dark:border-neutral-500">
        <h3 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
            {{ $titulo }}
        </h3>
    </div>

    <!-- Card body -->
    <div class="hidden md:block flex-1 p-5 space-y-3">

        <!-- Title -->
        <h2 class="mb-2 text-sm font-semibold tracking-wide text-sky-800 dark:text-neutral-50">
            {{ $subtitulo }}
        </h2>

        <!-- Text -->
        <p class="mb-2 text-base text-neutral-500 dark:text-neutral-300">
            {{ $contenido }}
        </p>

    </div>

    <!-- Card footer -->
    <div class="flex border-t-2 space-x-2 border-neutral-100 px-6 py-4 dark:border-neutral-500">
        <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
            <img src="https://ui-avatars.com/api?name={{ $autor }}" alt="desconocido"
                class="w-10 h-10 rounded-full">
            </img>
        </h5>
        <div class="flex flex-col justify-center">
            <span class="text-sm font-semibold text-slate-600 leading-4">{{ $autor }}</span>
            <span class="text-sm text-slate-500"> {{ date('d/m/Y H:i', strtotime($fecha)) }}</span>
        </div>
    </div>


    <!-- Card -->
</article>
