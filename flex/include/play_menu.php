<div id="play_menu" class="pure-u-lg-4-24">
    <img src="default/300.jpg" class="pure-img" id="thumbnail" />
    
    <div id="video">
        <video width="100%" height="100%" poster="default/300.jpg" controls="controls" preload="auto">
            <!-- MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7 -->
            <source type="video/mp4" src="videos/The.Big.Bang.Theory.S08E08.HDTV.x264-LOL.mp4" />
            <!-- Flash fallback for non-HTML5 browsers without JavaScript -->
            <object width="100%" type="application/x-shockwave-flash" data="flashmediaelement.swf">
                <param name="movie" value="flashmediaelement.swf" />
                <param name="flashvars" value="controls=true&file=videos/The.Big.Bang.Theory.S08E08.HDTV.x264-LOL.mp4" />
                <!-- Image as a last resort -->
                <img src="default/300.jpg" width="320" height="240" title="No video playback capabilities" />
            </object>
        </video>
    </div>
    <h2>Movie Name</h2>
    <p>Short Description</p>
    
    <br>
    <audio src="mp3/juicy.mp3" preload="auto" />
</div>
<script>
/*(function (window, document) {

    var layout   = document.getElementById('play_menu'),
        menu     = document.getElementById('play_menu'),
        menuLink = document.getElementById('play_menuLink');

    function toggleClass(element, className) {
        var classes = element.className.split(/\s+/),
            length = classes.length,
            i = 0;

        for(; i < length; i++) {
          if (classes[i] === className) {
            classes.splice(i, 1);
            break;
          }
        }
        // The className is not found
        if (length === classes.length) {
            classes.push(className);
        }

        element.className = classes.join(' ');
    }

    menuLink.onclick = function (e) {
        var active = 'active';

        e.preventDefault();
        toggleClass(layout, active);
        toggleClass(menu, active);
        toggleClass(menuLink, active);
    };

}(this, this.document));*/
</script>