<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu pure-menu-open">
            <a class="pure-menu-heading" href="#">Flex</a>

            <ul>
                <li class="pure-menu-selected"><a href="home.php">Home</a></li>
                <li class="menu-item-divided">
                    <a href="videos.php">Videos</a>
                </li>

                <li class="menu-item-divided">
                    <a href="#">Movies</a>
                </li>

                <li><a href="#">TV Shows</a></li>
                <li><a href="#">Music</a></li>
                <li><a href="include/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <script>
(function (window, document) {

    var layout   = document.getElementById('layout'),
        menu     = document.getElementById('menu'),
        menuLink = document.getElementById('menuLink');

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

}(this, this.document));
</script>