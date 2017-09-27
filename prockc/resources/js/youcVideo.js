
var youcVideo, playBtn, seekSlider, currentTimeText, durationTimeText, muteButton, prevVolume, volSlider, fullScreenBtn;

//window.onload = initializeVideoPlayer;

function initializeVideoPlayer(){
	youcVideo = document.getElementById("youcMainVideo");
	playBtn = document.getElementById("playPauseVideoBtn");
	seekSlider = document.getElementById("videoSeekSlider");
	currentTimeText = document.getElementById("currentTimeText");
	durationTimeText = document.getElementById("durationTimeText");
	muteButton = document.getElementById("muteButton");
	volSlider = document.getElementById("volumeSeekSlider");
	fullScreenBtn = document.getElementById("fullScreenBtn");

	if(playBtn != null){

		playBtn.addEventListener("click", playPauseVideo, false);
		seekSlider.addEventListener("change", vidSeek, false);
		youcVideo.addEventListener("timeupdate", seekTimeUpdate, false);
		currentTimeText.addEventListener("timeupdate", seekTimeUpdate, false);
		durationTimeText.addEventListener("timeupdate", seekTimeUpdate, false);
		muteButton.addEventListener("click", videoMute, false);
		volSlider.addEventListener("change", setVolume, false);
		fullScreenBtn.addEventListener("click", toggleFullScreen, false);
	}

}

function toggleFullScreen(){
	if(youcVideo.requestFullScreen){
		youcVideo.requestFullScreen();
	}else if(youcVideo.webkitRequestFullScreen){
		youcVideo.webkitRequestFullScreen();
	}else if(youcVideo.mozRequestFullScreen){
		youcVideo.mozRequestFullScreen();
	}
}

function setVolume(){
	youcVideo.volume = volSlider.value / 100;
	if(youcVideo.volume > 0){
		muteButton.innerHTML='<i class="fa fa-volume-up"></i>';
	}else{
		muteButton.innerHTML='<i class="fa fa-volume-off"></i>';
	}
}

function playPauseVideo(){
	if(youcVideo.paused){
		youcVideo.play();
		playBtn.innerHTML='<i class="fa fa-pause"></i>';
	}else{
		youcVideo.pause();
		playBtn.innerHTML='<i class="fa fa-play"></i>';
	}
}

function vidSeek(){
	var seekTo = youcVideo.duration * ( seekSlider.value / 100 );
	youcVideo.currentTime = seekTo;
}

function seekTimeUpdate(){
	var nt = youcVideo.currentTime * ( 100 / youcVideo.duration);
	seekSlider.value = nt;
	var currMins = Math.floor(youcVideo.currentTime / 60);
	var currSecs = Math.floor(youcVideo.currentTime - currMins * 60);
	var durMins = Math.floor(youcVideo.duration / 60);
	var durSecs = Math.floor(youcVideo.duration - durMins * 60);
	if(currSecs < 10){
		currSecs = "0" + currSecs;
	}
	if(durSecs < 10){
		durSecs = "0" + durSecs;
	}
	if(currMins < 10){
		currMins = "0" + currMins;
	}
	if(durMins < 10){
		durMins = "0" + durMins;
	}
	currentTimeText.innerHTML = currMins + ":" + currSecs;
	durationTimeText.innerHTML = durMins + ":" + durSecs;
}

function videoMute(){
	if(youcVideo.muted){
		youcVideo.muted = false;
		volSlider.value = prevVolume;
		youcVideo.volume = 0;
		setVolume();
	}else{
		youcVideo.muted = true;
		prevVolume = volSlider.value;
		volSlider.value = 0;
		setVolume();

	}
}


