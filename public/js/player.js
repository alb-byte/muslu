export let AudioPlayer = {
    audioPlayer: new Audio(),
    play(id, src, cb) {
        if (this.audioPlayer.id != id) {
            this.audioPlayer.id = id;
            this.audioPlayer.src = src;
        }
        if (this.audioPlayer.paused) {
            this.audioPlayer.play();
        } else {
            this.audioPlayer.pause();
        }
    },
    pause() {
        this.audioPlayer.pause();
    }
}
AudioPlayer.audioPlayer.id = 0;