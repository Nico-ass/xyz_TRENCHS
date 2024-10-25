<x-app title="Accueil">
    <main class="container-wide space-y-8">
        <section>
            <h1>
                Cette semaine <small>{{ trans_choice('tracks.count', $week->tracks_count) }}</small>
            </h1>

            <div class="grid">
                @foreach($tracks as $track)
                    <a href="{{ route('app.tracks.show', ['week' => $track->week->uri, 'track' => $track]) }}" class="block image">
                        <img src="{{ $track->player_thumbnail_url }}" alt="">
                        <div class="description">
                            <div class="text-right">
                                #{{ $loop->iteration }}
                            </div>
                            <div>
                                <h2 class="truncate">{{ $track->artist }}</h2>
                                <h3 class="truncate">{{ $track->title }}</h3>
                                <div class="metadata-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd" d="M4.5 2A2.5 2.5 0 0 0 2 4.5v3.879a2.5 2.5 0 0 0 .732 1.767l7.5 7.5a2.5 2.5 0 0 0 3.536 0l3.878-3.878a2.5 2.5 0 0 0 0-3.536l-7.5-7.5A2.5 2.5 0 0 0 8.38 2H4.5ZM5 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $track->category ? $track->category->name : 'Non défini' }}</span> <!-- Affiche la catégorie ou 'Non défini' -->
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

                <a class="block" href="{{ route('app.weeks.index') }}">
                    <div class="description">
                        <div class="text-right">
                            <svg class="size-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                        <div>
                            <h3>Voir plus</h3>
                        </div>
                    </div>
                </a>
            </div>
        </section>

        <section>
            <h1>Semaines précédentes</h1>

            <div class="grid">
                @foreach($weeks as $week)
                    <a href="{{ route('app.weeks.show', ['week' => $week->uri]) }}" class="block image">
                        <div class="description">
                            <div>
                                <!--  -->
                            </div>
                            <div>
                                <h2>{{ $week->name }}</h2>
                                <h3>{{ trans_choice('tracks.count', $week->tracks_count) }}</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <section>
            <h1>À propos</h1>
            <p>
                XYZ est une communauté musicale accessible sur invitation.
            </p>
            <ul>
                <li>Le contenu est regroupé par semaine</li>
                <li>Vous pouvez publier jusqu’à 2 titres chaque semaine</li>
                <li>La communauté détermine le classement de la semaine</li>
            </ul>
        </section>
    </main>
</x-app>
