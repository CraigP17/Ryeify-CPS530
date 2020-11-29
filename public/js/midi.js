        const WHITE_KEYS = ['z', 'x', 'c', 'v', 'b', 'n', 'm']
        const BLACK_KEYS = ['s', 'd', 'g', 'h', 'j']

        const keys = document.querySelectorAll('.key')
        const whiteKeys = document.querySelectorAll('.key.white')
        const blackKeys = document.querySelectorAll('.key.black')

        keys.forEach(key => {
            key.addEventListener('click', () => playNote(key))
        })

        document.addEventListener('keydown', e => {
            if (e.repeat) return
            const key = e.key
            //checks black or white keys
            const whiteKeyIndex = WHITE_KEYS.indexOf(key)
            const blackKeyIndex = BLACK_KEYS.indexOf(key)

            if (whiteKeyIndex > -1) playNote(whiteKeys[whiteKeyIndex])
            if (blackKeyIndex > -1) playNote(blackKeys[blackKeyIndex])
        })

        //plays the note on pressing a specific key
        function playNote(key) {
            const noteAudio = document.getElementById(key.dataset.note)
            //restarting the thing at beginning like a normal piano
            noteAudio.currentTime = 0
            noteAudio.play()
            //change color on playing key to indicate press
            key.classList.add('active')
            //removes offset color once event is over
            noteAudio.addEventListener('ended', () => {
                key.classList.remove('active')
            })
        }