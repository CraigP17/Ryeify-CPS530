<?php ?>

<h1 class="mb-4">Lyric Finder</h1>
<div class="row d-flex justify-content-center">
    <form id="form">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <input type="text" class="form-control mb-2" id="inlineFormInput"
                    placeholder="Enter Artist Or Song Name!" />
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Search</button>
            </div>
        </div>
    </form>
    <div id="result" class="container centred">
        <p>The lyrics to your favorite song will be here...</p>
    </div>
    <div id="more" class="container centred"></div>
</div>
<script src="/js/lyrics.js"></script>