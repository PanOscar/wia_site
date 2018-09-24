/**
 * @author Oskar Bergmann
 * @inspired by Brad Traversy 
 * @copyright NIE usuwaj tego komentarza! (Do NOT remove this comment!)
 */
 
/*****FOR EACH AUDIO PLAYER*******/
$('.audioPlayer').each(function(i, el) {
	var audio = document.getElementsByTagName('audio')[i];
	/*****HIDE PAUSE IN START*******/
	$(el).find('.pause').hide();
	var percentage;
	/*****CREATE ELEMENT*******/
	var audioElement = document.createElement('audio');   
	var src = $(el).find('audio > source');
	var song = src.attr('src');
	audioElement.setAttribute('src', song);
	audioElement.addEventListener("loadedmetadata", function() {
		var duration = audioElement.duration;
		var sD = parseInt(audioElement.duration % 60);
		var mD = parseInt((audioElement.duration / 60) % 60);
		if (sD < 10) {
			sD = '0' + sD;
		}
		$(el).find('.duration').html('0:00/'+ mD + ':' + sD);
	});
	/*****PLAY BUTTON*******/
	$(el).find('.play').click(function(){
		audio.play();
		$(el).find('.play').hide();
		$(el).find('.pause').show();
		$(el).find('.duration').show();
		showDuration();
	});
	/*****PAUSE BUTTON*******/
	$(el).find('.pause').click(function(){
		audio.pause();
		$(el).find('.pause').hide();
		$(el).find('.play').show();
	});
	/*****TIME DURATION*******/
	var widthProgress = document.getElementsByClassName("progressBar")[i].offsetWidth /100;
	function showDuration(){
		$(audio).bind('timeupdate', function(){
			//Get hours and minutes
			var s = parseInt(audio.currentTime % 60);
			var m = parseInt((audio.currentTime / 60) % 60);
			var sD = parseInt(audio.duration % 60);
			var mD = parseInt((audio.duration /60) % 60);
			//Add 0 if seconds less than 10
			if (s < 10) {
				s = '0' + s;
			}
			if (sD < 10) {
				sD = '0' + sD;
			}
			$(el).find('.duration').html(m + ':' + s + '/' + mD + ':' + sD);	
			var value = 0;
			if (audio.currentTime > 0) {
				value = Math.floor((100 / audio.duration) * audio.currentTime);
			}
			$(el).find('.progress').css('width',value+'%');
			$(el).find('#audio-progress-handle').css('marginLeft',widthProgress*value+'px');
		});
	};
	/*****UPDATE ICONS*******/
	var updateIcons = function(){
		if (audio.volume <= 0.25 && audio.volume > 0) {
			$(el).find('.vol').removeClass("vol_medium").removeClass("vol_high").removeClass("vol_zero").addClass("vol_low");
		} else if (audio.volume > 0.75) {
			$(el).find('.vol').removeClass("vol_medium").removeClass("vol_low").removeClass("vol_zero").addClass("vol_high");
		} else if(audio.volume <= 0.75 && audio.volume > 0.25) {
			$(el).find('.vol').removeClass("vol_low").removeClass("vol_high").removeClass("vol_zero").addClass("vol_medium");
		} else if(audio.volume == 0){
			$(el).find('.vol').removeClass("vol_medium").removeClass("vol_high").removeClass("vol_low").addClass("vol_zero");
		}
	};	
	/*****SET PERCENTAGE VALUE OF VOLUME BACKGROUND*******/
	var volumeBar = function(){
		//update volume bar and video volume
		var a = function(){
			if($(el).find('.volume').val()/10 <= 50){
				return ($(el).find('.volume').val()/10)+10;
			}else {
				return $(el).find('.volume').val()/10;
			}
		}
		$(el).find('.volumeBar').css('width', a()  + '%');
	}
	/*****MOUSE EVENTS VOLUME*******/
	var volumeDrag = false;
	$(el).find('.volumeDiv').on('mousedown', function (e) {
		volumeDrag = true;
		audio.muted = false;
		updateVolume(e.pageX);
	});
	$(document).on('mouseup', function (e) {
		if (volumeDrag) {
			volumeDrag = false;
			updateVolume(e.pageX);
		}
	});
	$(document).on('mousemove', function (e) {
		if (volumeDrag) {
			updateVolume(e.pageX);
		}
	});
	/*****MOUSE EVENTS PROGRESS*******/
	var bar = document.getElementsByClassName('progressBar')[i];
	bar.addEventListener('click',updateProgress,false);
	/*****PERCENTAGE VALUE OF PROGRESS RANGE FROM LEFT*******/
	function updateProgress(e){
		var progress = document.getElementsByClassName('progress')[i];

		if(!audio.ended){
			var positionP = e.pageX - bar.offsetLeft -135;
			var percentage = 100 * positionP / bar.offsetWidth;
			console.log();
			var newtime = positionP*audio.duration/75;
			
			audio.currentTime = percentage * audio.duration /100;
			progress.style.width = positionP + 'px';
		}
	};
	/*****PERCENTAGE VALUE OF VOLUME RANGE FROM LEFT*******/
	var updateVolume = function (x, vol) {
		var volume = $(el).find('.volumeDiv');
		//if only volume have specificed
		//then direct update volume
		if (vol) {
			percentage = vol * 100;
		} else {
			var position = x - volume.offset().left;
			percentage = 100 * position / volume.width();
		}
		if (percentage > 100) {
			percentage = 100;
		}
		if (percentage < 0) {
			percentage = 0;
		}
		audio.volume = percentage / 100;
		$(el).find('.volume').val(audio.volume*1000);
		volumeBar();
		updateIcons();
	};
	/*****GIVE START VALUE OF VOLUME BACKGROUND*******/
	volumeBar();
	/*****ON VOLUME CHANGE VOLUME ICONS AND BACKGROUND*******/
	$(el).find('.volume').change(function(){
		audio.volume = parseFloat(this.value / 1000);
		volumeBar();
		updateIcons();
	});
	/*****MUTE/UNMUTE ON VALUE ICON CLICK*******/
	$(el).find('.vol').on('click',function(){
		if(audio.volume == 0){
			$(el).find('.volume').val(percentage*10); 
			audio.volume = $(el).find('.volume').val()/ 1000;
			volumeBar();
			updateIcons();
		}else{
			$(el).find('.volume').val('0'); 
			audio.volume = 0;
			volumeBar();
			updateIcons();
		}
	});
	/*****ON PLAYER HOVER SHOW COMMENT*******/
	$(el).hover(function() { 
		$(el).find('.comment').fadeIn(); 
	}, function() { 
		$(el).find('.comment').fadeOut(); 
	});		
});

$(document).on('click', 'a', function(e){
   e.preventDeafult(); //don't let browser follow the link

   var href = $(this).attr('href'); //get the href from original link
   var options = "toolbar=no,location=no,directories=no,menubar=no,scrollbars=yes,width=500,height=500";
  //Now open the popup
  window.open(href, 'NameOfTheWindow', options);
})
