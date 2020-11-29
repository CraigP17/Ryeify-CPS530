<?php ?>
<head>
    <link rel="stylesheet" href="/css/midi.css">
</head>
<body>
    <div class="main">
        <h1>A Midi inspired Piano</h1>
    </div>
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
    </div>
    <script src="/js/midi.js"></script>
</body>