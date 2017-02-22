

    <videogular >
    <vg-media vg-src="vid.sources"
            vg-tracks="vid.tracks">
    </vg-media>

    <vg-controls>
        <vg-play-pause-button></vg-play-pause-button>
        <vg-time-display><% currentTime | date:'mm:ss' %></vg-time-display>
        <vg-scrub-bar>
            <vg-scrub-bar-current-time></vg-scrub-bar-current-time>
        </vg-scrub-bar>
        <vg-time-display><% timeLeft | date:'mm:ss' %></vg-time-display>
        <vg-volume>
            <vg-mute-button></vg-mute-button>
            <vg-volume-bar></vg-volume-bar>
        </vg-volume>
        <vg-fullscreen-button></vg-fullscreen-button>
    </vg-controls>

    <vg-overlay-play></vg-overlay-play>
    <vg-poster vg-url='/img/bg-shadow.png'></vg-poster>
</videogular>