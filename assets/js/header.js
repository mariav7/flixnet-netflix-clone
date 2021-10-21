// Navbar
$(document).scroll(function(){  
  let isScrolled = $(this).scrollTop() > $(".topBar").height();
  $(".topBar").toggleClass("scrolled", isScrolled);
} )

function menuBurger(buttonMenu) {
  $("#menuShow").toggle();

  $(buttonMenu).find("i").toggleClass("fas fa-times");
  $(buttonMenu).find("i").toggleClass("fa fa-bars");
};
  

// Volume on video
function volumeToggle(button) {
  let muted = $(".previewVideo").prop("muted");
  $(".previewVideo").prop("muted", !muted);

  $(button).find("i").toggleClass("fa-volume-mute");
  $(button).find("i").toggleClass("fa-volume-up");
  }

// When preview video ends show preview image
function previewEnded() {
  $(".previewVideo").toggle();
  $(".previewImage").toggle();
}

// Left arrow on video goes back to dashboard.php
function goBack(entityId) {
  window.location.href = "entity.php?id=" + entityId;
  //window.history.back();
}

// Left arrow with title disappears if mouse not moving
function startHideTimer() {
  let timeout = null;

  $(document).on("mousemove", function() {
    clearTimeout(timeout);
    $(".watchNav").fadeIn();

    timeout = setTimeout(function() {
      $(".watchNav").fadeOut();
    }, 2000);
  })
}

// Function which initializes the video in watch.php
function initVideo(videoId, username) {
  startHideTimer();
  setStartTime(videoId, username);
  updateProgressTimer(videoId, username);
}

function updateProgressTimer(videoId, username) {
  addDuration(videoId, username);

  let timer;

  $("video").on("playing", function(event) {
    window.clearInterval(timer);
    timer = window.setInterval(function() {    
      updateProgress(videoId, username, event.target.currentTime);    
    }, 3000);
  })

  .on("ended", function() {
    setFinished(videoId, username);
    window.clearInterval(timer);
  })
}

function addDuration(videoId, username) {
  $.post("ajax/addDuration.php", { videoId: videoId, username: username }, function(data) {
    if(data !== null && data !== "") {
      alert(data);
    }
  })
}

function updateProgress(videoId , username , progress){
  $.post("ajax/updateDuration.php", { videoId: videoId, username: username , progress:progress }, function(data) {
    if(data !== null && data !== "") {
      alert(data);
    }
  })
}

function setFinished(videoId , username){
  $.post("ajax/setFinished.php", { videoId: videoId, username: username }, function(data) {
    if(data !== null && data !== "") {
      alert(data);
    }
  })
}

function setStartTime(videoId , username){
  $.post("ajax/getProgress.php", { videoId: videoId, username: username }, function(data) {
    if( isNaN(data) ) {
      alert(data);
      return;
    }
    
    $("video").on("canplay", function(){    
      this.currentTime = data;
      $("video").off("canplay");
    }) 
  })
}

// Button restart video
function restartVideo(){
  $("video")[0].currentTime = 0; 
  $("video")[0].play(); 
  
  $(".upNext").fadeOut();
}

// Button Show up next video
function watchVideo(videoId){
  window.location.href = "watch.php?id=" + videoId;
}

function showUpNext(){
  $(".upNext").fadeIn();
}

$(document).ready(function () {
  $('.entities').on('mousewheel', function (event) {
    console.log(event.originalEvent);

    if (event.originalEvent.deltaY > 0) this.scrollLeft += 100;
    else this.scrollLeft -= 100;this

    event.preventDefault();
  });
})
