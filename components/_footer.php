<?php
if( $first_url_segment === "index.php" || $first_url_segment === "" ) {
    echo "<footer class='bg bg--light'>";
} else {
    echo "<footer class='bg bg--featured'>";
}
?>
    <div class="footer__inner">
        <div class="flex flex--justify-space-between">
            <div>
                <div class="grid grid--m flex flex--wrap">
                    <ul class="grid__item">
                        <li><a class="a" href="files/durra-cv.pdf" target="_blank">
                            View my CV
                        </a></li>
                        <li><a href="tel:+447307479096">+44(0)7307479096</a></li>
                        <li><a href="mailto:durrao.brien@gmail.com">durrao.brien@gmail.com</a></li>
                    </ul>
                    <ul class="grid__item">
                        <li><a href="https://www.linkedin.com/in/durra-shuazlan-57b688195/?originalSubdomain=uk" target="_blank">LinkedIn</a></li>
                        <li><a href="https://github.com/durrashuaz" target="_blank">GitHub</a></li>
                    </ul>
                </div>
                <div class="footer__secondary">&copy; September 27, 2022</div>
            </div>
            <!-- <img src="../../images/logo.png" alt="logo" width="150" height="80"> -->
        </div>
    </div>
</footer>
<script src="../main.js"></script>

<?php $conn->close(); ?>