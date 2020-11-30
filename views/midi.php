<?php ?>

<h1>A Midi Inspired Piano</h1>
<div class="row d-flex justify-content-center">
    <div class="piano">
        <div data-note="C" class="key white"></div>
        <div data-note="Db" class="key black"></div>
        <div data-note="D" class="key white"></div>
        <div data-note="Eb" class="key black"></div>
        <div data-note="E" class="key white"></div>
        <div data-note="F" class="key white"></div>
        <div data-note="Gb" class="key black"></div>
        <div data-note="G" class="key white"></div>
        <div data-note="Ab" class="key black"></div>
        <div data-note="A" class="key white"></div>
        <div data-note="Bb" class="key black"></div>
        <div data-note="B" class="key white"></div>
    </div>

    <audio id="C" src="notes/C.mp3"></audio>
    <audio id="Db" src="notes/Db.mp3"></audio>
    <audio id="D" src="notes/D.mp3"></audio>
    <audio id="Eb" src="notes/Eb.mp3"></audio>
    <audio id="E" src="notes/E.mp3"></audio>
    <audio id="F" src="notes/F.mp3"></audio>
    <audio id="Gb" src="notes/Gb.mp3"></audio>
    <audio id="G" src="notes/G.mp3"></audio>
    <audio id="Ab" src="notes/Ab.mp3"></audio>
    <audio id="A" src="notes/A.mp3"></audio>
    <audio id="Bb" src="notes/Bb.mp3"></audio>
    <audio id="B" src="notes/B.mp3"></audio>
    <div class="card" style="width: 55rem;">
        <div class="card-body">
            <p class="card-text">MIDI (/ˈmɪdi/; an acronym for Musical Instrument Digital Interface) is a technical
                standard that describes a communications protocol, digital interface, and electrical connectors that
                connect a wide variety of electronic musical instruments, computers, and related audio devices for
                playing, editing and recording music</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>How to play notes?</strong></li>
            <li class="list-group-item">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Keystroke</th>
                            <th scope="col">Corresponding Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Z</th>
                            <td>C</td>
                        </tr>
                        <tr>
                            <th scope="row">S</th>
                            <td>Db/C#</td>
                        </tr>
                        <tr>
                            <th scope="row">X</th>
                            <td>D</td>
                        </tr>
                        <tr>
                            <th scope="row">D</th>
                            <td>Eb/D#</td>
                        </tr>
                        <tr>
                            <th scope="row">C</th>
                            <td>E</td>
                        </tr>
                        <tr>
                            <th scope="row">V</th>
                            <td>F</td>
                        </tr>
                        <tr>
                            <th scope="row">G</th>
                            <td>Gb/F#</td>
                        </tr>
                        <tr>
                            <th scope="row">B</th>
                            <td>G</td>
                        </tr>
                        <tr>
                            <th scope="row">H</th>
                            <td>Ab/G#</td>
                        </tr>
                        <tr>
                            <th scope="row">N</th>
                            <td>A</td>
                        </tr>
                        <tr>
                            <th scope="row">J</th>
                            <td>Bb/A#</td>
                        </tr>
                        <tr>
                            <th scope="row">M</th>
                            <td>B</td>
                        </tr>
                    </tbody>
                </table>
            </li>
        </ul>
        <div class="card-body">
            <a href="https://en.wikipedia.org/wiki/MIDI_keyboard" target="blank" class="card-link">Learn more about
                MIDI</a>
            <a href="https://www.schoolofrock.com/resources/keyboard/piano-chords-for-beginners" target="blank"
                class="card-link">How to play Chords</a>
        </div>
    </div>
</div>
<script src="/js/midi.js"></script>