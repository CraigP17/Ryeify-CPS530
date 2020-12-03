const form = document.getElementById('form');
const search = document.getElementById('inlineFormInput');
const result = document.getElementById('result');
const more = document.getElementById('more');

const apiURL = 'https://api.lyrics.ovh';

// Search for a song or an artist
async function searchSongs(term) {
    const res = await fetch(`${apiURL}/suggest/${term}`);
    const data = await res.json();

    showData(data);
}

// Show song and artist using DOM creation and traversal
function showData(data) {
    result.innerHTML = `
    <ol class="songs">
      ${data.data
        .map(
          song => `<li>
      <span><strong>${song.artist.name}</strong> - ${song.title}</span>
      <button class="btn" data-artist="${song.artist.name}" data-songtitle="${song.title}">Get Lyrics</button>
    </li>`
        )
        .join('')}
    </ol>
  `;

// Show previous and next button functionality
    if (data.prev || data.next) {
        more.innerHTML = `
      ${
        data.prev
          ? `<button class="btn" onclick="getMoreSongs('${data.prev}')">Prev</button>`
          : ''
      }
      ${
        data.next
          ? `<button class="btn" onclick="getMoreSongs('${data.next}')">Next</button>`
          : ''
      }
    `;
    } else {
        more.innerHTML = '';
    }
}

// Get previous and next songs
async function getMoreSongs(url) {
    const res = await fetch(`https://cors-anywhere.herokuapp.com/${url}`);
    const data = await res.json();

    showData(data);
}

// Get lyrics for the searched song
async function getLyrics(artist, songTitle) {
    const res = await fetch(`${apiURL}/v1/${artist}/${songTitle}`);
    const data = await res.json();

    if (data.error) {
        result.innerHTML = data.error;
    } else {
        const lyrics = data.lyrics.replace(/(\r\n|\r|\n)/g, '<br>');

        result.innerHTML = `
            <h2><strong>${artist}</strong> - ${songTitle}</h2>
            <span>${lyrics}</span>
        `;
    }

    more.innerHTML = '';
}


// Event listeners for user strokes
form.addEventListener('submit', e => {
    e.preventDefault();

    const searchTerm = search.value.trim();

    if (!searchTerm) {
        alert('Please search for a known artist!');
    } else {
        searchSongs(searchTerm);
    }
});

// Get lyrics on button click
result.addEventListener('click', e => {
    const clickedEl = e.target;

    if (clickedEl.tagName === 'BUTTON') {
        const artist = clickedEl.getAttribute('data-artist');
        const songTitle = clickedEl.getAttribute('data-songtitle');

        getLyrics(artist, songTitle);
    }
});